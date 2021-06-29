<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ImageContent extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Image & Content';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Show text next to an image';

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
    public $icon = 'align-pull-left';

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
        'align' => ['full', 'wide'],
        'align_text' => false,
        'align_content' => false,
        'anchor' => false,
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
            'image' => Acf::get_field('image')->default('https://picsum.photos/500/500'),
            'imagePosition' => Acf::get_field('settings')->get('image_position')->default('left'),
            'backgroundColor' => Acf::get_field('settings')->get('background_color')->default('transparent'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $imageContent = new FieldsBuilder('image_content');

        $imageContent
            ->addImage('image', [
                'label' => __('Image', 'sage')
            ])
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
            ])
                ->addSelect('image_position', [
                    'label' => __('Image position', 'sage'),
                    'allow_null' => true,
                    'choices' => [
                        'left' => __('Left', 'sage'),
                        'right' => __('Right', 'sage'),
                    ],
                ])
                ->addSelect('background_color', [
                    'label' => __('Background color', 'sage'),
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

        return $imageContent->build();
    }
}
