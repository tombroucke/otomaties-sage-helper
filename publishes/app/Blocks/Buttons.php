<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;
use ThemeJson;

class Buttons extends Block
{
    /**
     * The internal ACF block version.
     *
     * @var int
     */
    public $blockVersion = 1;

    /**
     * The internal ACF block version.
     *
     * @var int
     */
    public $apiVersion = 1;

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'custom';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'button';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => ['wide', 'full'],
        'align_content' => false,
        'align_text' => true,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
        'jsx' => false,
    ];

    /**
     * Set title, description & slug, allow for translation
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Buttons', 'sage');
        $this->slug = 'buttons';
        $this->description = __('Display multiple buttons', 'sage');
        parent::__construct($composer);
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'buttons' => AcfObjects::getField('buttons'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $themes = [];
        foreach (ThemeJson::colors() as $themeColor) {
            $themeName = $themeColor['name'];
            $themeSlug = $themeColor['slug'];
            $themes[$themeSlug] = $themeName;
            $themes['outline-' . $themeSlug] = sprintf('%s %s', $themeName, __('outline', 'sage'));
        }

        $buttons = Builder::make('buttons');
        $buttons
            ->addRepeater('buttons', [
                'label' => __('Buttons', 'sage'),
            ])
            ->addLink('button', [
                'label' => __('Button', 'sage'),
            ])
            ->addSelect('theme', [
                'label' => __('Theme', 'sage'),
                'choices' => $themes,
                'default_value' => array_key_first($themes),
            ])
            ->endRepeater();

        return $buttons->build();
    }
}
