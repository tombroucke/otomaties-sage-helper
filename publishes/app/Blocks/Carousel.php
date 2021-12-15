<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use Roots\Acorn\Application;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Carousel extends Block
{
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
    public $icon = 'images-alt2';

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
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
        'jsx' => false,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->name = __('Carousel', 'sage');
        $this->slug = 'carousel';
        $this->description = __('Show images in a carousel', 'sage');
        parent::__construct($app);
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'slides' => Acf::get_field('slides'),
            'sliderSettings' => $this->sliderSettings(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $carousel = new FieldsBuilder('carousel');

        $carousel
            ->addRepeater('slides', [
                'label' => __('Slides', 'sage'),
                'layout' => 'block',
            ])
                ->addImage('image', [
                    'label' => __('Image', 'sage')
                ])
                ->addText('title', [
                    'label' => __('Title', 'sage')
                ])
            ->endRepeater()
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
            ])
                ->addSelect('slides_to_show', [
                    'label' => __('Slides to show', 'sage'),
                    'allow_null' => false,
                    'choices' => [1, 2, 3, 4, 5],
                    'default_value' => 3
                ])
                ->addNumber('autoplay_speed', [
                    'label' => __('Autoplay speed (in milliseconds)', 'sage'),
                    'description' => __('Set to 0 to disable autoplay', 'sage'),
                    'allow_null' => false,
                    'default_value' => 4000
                ])
                ->addTrueFalse('dots', [
                    'label' => __('Dots', 'sage'),
                    'default_value' => true
                ])
                ->addTrueFalse('arrows', [
                    'label' => __('Arrows', 'sage'),
                    'default_value' => true
                ])
            ->endGroup();

        return $carousel->build();
    }

    /**
     * Return the items field.
     *
     * @return array
     */
    public function items()
    {
        return Acf::get_field('slides');
    }

    /**
     * Get slick slider settings
     *
     * @return string The returned string is Json
     */
    public function sliderSettings() {
        $settings = Acf::get_field('settings');
        $sliderSettings = [
            'dots' => $settings->get('dots'),
            'arrows' => $settings->get('arrows'),
            'slidesToShow' => $settings->get('slides_to_show')->default(3)->value(),
            'slidesToScroll' => 1,
            'autoplay' => 'true',
            'autoplaySpeed' => $settings->get('autoplay_speed')->default(4000)->value(),
        ];
        return json_encode($sliderSettings, JSON_HEX_APOS);
    }
}
