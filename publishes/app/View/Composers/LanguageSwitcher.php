<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class LanguageSwitcher extends Composer
{
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
        $languages = $this->languages();
        $activeLanguage = $languages[0];
        array_shift($languages);
        return [
            'activeLanguage' => $activeLanguage,
            'languages' => $languages,
        ];
    }

    public function languages()
    {
        $return = array();
        $languages = array_reverse(icl_get_languages('skip_missing=0&orderby=KEY&order=DIR'));
        if (count($languages) >= 1) {
            foreach ($languages as $language) {
                if ($language['active']) {
                    $return[] = $language;
                }
            }
            foreach ($languages as $language) {
                if (!$language['active']) {
                    $return[] = $language;
                }
            }
        }
        return $return;
    }
}
