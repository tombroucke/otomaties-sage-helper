<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ColoredBackground extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Colored Background';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Colored Background block.';

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
    public $icon = 'admin-customizer';

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
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'mode' => false,
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
            'backgroundColor' => Acf::get_field('background_color'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $coloredBackground = new FieldsBuilder('colored_background');

        $coloredBackground
            ->addSelect('background_color', [
                'choices' => [
                    'primary' => __('Primary', 'sage'),
                    'secondary' => __('Secondary', 'sage'),
                    'success' => __('Success', 'sage'),
                    'danger' => __('Danger', 'sage'),
                    'warning' => __('Warning', 'sage'),
                    'info' => __('Info', 'sage'),
                    'light' => __('Light', 'sage'),
                    'dark' => __('Dark', 'sage'),
                ]
            ]);

        return $coloredBackground->build();
    }
}
