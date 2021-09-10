<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Logos extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Logos';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Logos block.';

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
    public $icon = 'grid-view';

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
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => false,
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'logos' => Acf::get_field('logos'),
            'type' => Acf::get_field('type'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $logos = new FieldsBuilder('logos');

        $logos
            ->addRepeater('logos')
                ->addImage('logo', [
                    'label' => __('Logo', 'sage'),
                    'required' => true,
                ])
                ->addLink('link', [
                    'label' => __('Link', 'sage')
                ])
            ->endRepeater()
            ->addSelect('type', [
                'label' => __('Type', 'sage'),
                'choices' => array(
                    'grid' => __('Grid', 'sage'),
                    'carousel' => __('Carousel', 'sage'),
                ),
                'default_value' => 'grid',
            ]);

        return $logos->build();
    }
}
