<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Header extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Header';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Show a header on top of a page';

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
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'title' => Acf::get_field('title'),
            'background_image' => Acf::get_field('background_image')->default(\Roots\asset('images/hero.jpg')->uri()),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $header = new FieldsBuilder('header');

        $header
            ->addText('title', [
                'label' => __('Title', 'sage')
            ])
            ->addImage('background_image', [
                'label' => __('Background image', 'sage'),
                'required' => true
            ]);

        return $header->build();
    }
}
