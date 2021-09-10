<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeroSlider extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Hero slider';

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
        'align_text' => false,
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
            'items' => Acf::get_field('items'),
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
        $heroSlider = new FieldsBuilder('hero_slider');

        $heroSlider
            ->addRepeater('items', [
                'label' => __('Items', 'sage'),
                'layout' => 'block',
            ])
                ->addImage('background_image', [
                    'label' => __('Background image', 'sage'),
                    'required' => true
                ])
                ->addText('title', [
                    'label' => __('Title', 'sage')
                ])
                ->addText('subtitle', [
                    'label' => __('Subtitle', 'sage')
                ])
                ->addRepeater('buttons', [
                    'label' => __('Buttons', 'sage'),
                ])
                    ->addLink('button', [
                        'label' => __('Button', 'sage'),
                    ])
                    ->addSelect('style', [
                        'label' => __('Style', 'sage'),
                        'choices' => array(
                            'primary' => __('Primary', 'sage'),
                            'secondary' => __('Secondary', 'sage'),
                            'success' => __('Success', 'sage'),
                            'danger' => __('Danger', 'sage'),
                            'warning' => __('Warning', 'sage'),
                            'info' => __('Info', 'sage'),
                            'light' => __('Light', 'sage'),
                            'dark' => __('Dark', 'sage'),
                            'white' => __('White', 'sage'),
                        ),
                        'default_value' => 'primary',
                    ])
                ->endRepeater()
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
                    ->addTrueFalse('group_buttons', [
                        'label' => __('Group buttons', 'sage'),
                        'message' => __('Show buttons as a group', 'sage'),
                        'default_value' => false,
                    ])
                    ->addSelect('content_position', [
                        'label' => __('Content position', 'sage'),
                        'choices' => [
                            'left' => __('Left', 'sage'),
                            'right' => __('Right', 'sage'),
                        ],
                    ])
                ->endGroup()
            ->endRepeater()
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
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

        return $heroSlider->build();
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
            'slidesToScroll' => 1,
            'slidesToShow' => 1,
            'autoplay' => 'true',
            'autoplaySpeed' => $settings->get('autoplay_speed')->value(),
        ];
        return json_encode($sliderSettings, JSON_HEX_APOS);
    }
}
