<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class LanguageSwitcher extends Composer
{
    /**
     * Array of WPML languages
     *
     * @var array
     */
    private $languages = [];

    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.language-switcher',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'activeLanguage' => $this->activeLanguage(),
            'inactiveLanguages' => $this->inactiveLanguages(),
        ];
    }

    /**
     * Get active language
     *
     * @return object
     */
    public function activeLanguage() : object
    {
        $activeLanguages = array_filter($this->languages(), function ($language) {
            return $language->active;
        });
        return reset($activeLanguages);
    }

    /**
     * Get active language
     *
     * @return array Array of language objects
     */
    public function inactiveLanguages() : array
    {
        $inactiveLanguages = array_filter($this->languages(), function ($language) {
            return !$language->active;
        });
        return $inactiveLanguages;
    }

    /**
     * Get WPML languages
     *
     * @return array
     */
    private function languages() : array
    {
        if (!$this->languages) {
            $this->languages = array_reverse(icl_get_languages('skip_missing=0&orderby=KEY&order=DIR'));
        }

        // Return object instead of array
        return array_map(function ($language) {
            return (object)$language;
        }, $this->languages );
    }
}
