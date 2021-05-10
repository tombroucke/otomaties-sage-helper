<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Hero extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Hero';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display a static hero on top of your page';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'formatting';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'desktop';

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
    public $align = 'full';

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
        'align' => array('full'),
        'align_text' => true,
        'align_content' => false,
        'anchor' => false,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'background_image' => Acf::get_field('background_image')->default(\Roots\asset('images/hero.jpg')->uri()),
            'settings' => Acf::get_field('settings')
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $hero = new FieldsBuilder('hero');

        $hero
            ->addImage('background_image', [
                'label' => __('Background image', 'sage'),
                'required' => true
            ])
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
            ])
                ->addSelect('text_color', [
                    'label' => __('Text color', 'sage'),
                    'allow_null' => true,
                    'choices' => [
                        'primary' => __('Primary', 'sage'),
                        'secondary' => __('Secondary', 'sage'),
                        'success' => __('Success', 'sage'),
                        'danger' => __('Danger', 'sage'),
                        'warning' => __('Warning', 'sage'),
                        'info' => __('Info', 'sage'),
                        'light' => __('Light', 'sage'),
                        'dark' => __('Dark', 'sage'),
                        'white' => __('White', 'sage'),
                    ],
                ])
            ->endGroup();

        return $hero->build();
    }
}
