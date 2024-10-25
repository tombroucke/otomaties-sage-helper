<?php

namespace App\Blocks;

use Illuminate\Support\Str;
use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;

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

    private $sizes = [];

    /**
     * Set title, description & slug, allow for translation
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Carousel', 'sage');
        $this->slug = 'carousel';
        $this->description = __('Show images in a carousel', 'sage');

        $this->sizes = [
            'mobile' => [
                'label' => __('Mobile & up'),
                'size' => 0,
            ],
            'tablet' => [
                'label' => __('Tablet & up'),
                'size' => 768,
            ],
            'desktop' => [
                'label' => __('Desktop & up'),
                'size' => 1200,
            ],
        ];

        parent::__construct($composer);
    }

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        $uid = uniqid('carousel-');
        $breakpoints = collect(AcfObjects::getField('settings')->get('breakpoints'))
            ->mapWithKeys(function ($breakpoint, $key) {
                return [$breakpoint['breakpoint']->toString() => $breakpoint];
            })
            ->sort(function ($a, $b) {
                $sizes = array_keys($this->sizes);

                return array_search($a['breakpoint'], $sizes) - array_search($b['breakpoint'], $sizes);
            })
            ->mapWithKeys(function ($breakpoint, $key) {
                return [$this->sizes[$key]['size'] => $breakpoint];
            })
            ->map(function ($breakpoint) {
                unset($breakpoint['breakpoint']);

                return collect($breakpoint)
                    ->map(function ($value, $key) {
                        return $value->getValue();
                    })
                    ->mapWithKeys(function ($value, $key) {
                        return [Str::camel($key) => $value];
                    })
                    ->mapWithKeys(function ($value, $key) {
                        if ($key == 'autoplay') {
                            $value = $value != 0 ? [
                                'delay' => $value,
                                'disableOnInteraction' => false,
                                'enabled' => true,
                            ] : [
                                'enabled' => false,
                            ];
                        }

                        return [$key => $value];
                    })
                    ->filter()
                    ->toArray();
            });

        $settings = collect($breakpoints->first())->toJson();
        $breakpoints = $breakpoints->except($breakpoints->keys()->first())->toJson();

        return [
            'slides' => AcfObjects::getField('slides'),
            'uid' => $uid,
            'allowedBlocks' => collect([
                'acf/slide',
            ])->toJson(),
            'navigation' => AcfObjects::getField('settings')->get('navigation'),
            'loop' => AcfObjects::getField('settings')->get('loop'),
            'centeredSlides' => AcfObjects::getField('settings')->get('centered_slides'),
            'settings' => $settings,
            'breakpoints' => $breakpoints,
        ];
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $carousel = Builder::make('carousel');

        $carousel
            ->addRepeater('slides', [
                'label' => __('Slides', 'sage'),
                'layout' => 'block',
            ])
            ->addImage('image', [
                'label' => __('Image', 'sage'),
            ])
            ->endRepeater()
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
                'layout' => 'block',
            ])
            ->addTrueFalse('loop', [
                'label' => __('Loop', 'sage'),
                'instructions' => __('This carousel has no start nor end slide', 'sage'),
                'default_value' => false,
            ])
            ->addTrueFalse('navigation', [
                'label' => __('Navigation', 'sage'),
                'instructions' => __('Show navigation', 'sage'),
                'default_value' => true,
            ])
            ->addTrueFalse('centered_slides', [
                'label' => __('Centered slides', 'sage'),
                'instructions' => __('Center the active slide', 'sage'),
                'default_value' => false,
            ])
            ->addRepeater('breakpoints', [
                'label' => __('Breakpoints', 'sage'),
                'layout' => 'block',
                'button_label' => __('Add Breakpoint', 'sage'),
                'min' => 1,
            ])
            ->addSelect('breakpoint', [
                'label' => __('Breakpoint', 'sage'),
                'required' => true,
                'choices' => collect($this->sizes)
                    ->mapWithKeys(function ($size, $key) {
                        return [$key => $size['label']];
                    }),
                'default_value' => collect($this->sizes)->keys()->first(),
            ])
            ->addSelect('slides_per_view', [
                'label' => __('Slides per view', 'sage'),
                'required' => true,
                'choices' => [
                    '1' => '1',
                    '1.5' => '1.5',
                    '2' => '2',
                    '2.5' => '2.5',
                    '3' => '3',
                    '3.5' => '3.5',
                    '4' => '4',
                    '4.5' => '4.5',
                ],
                'default_value' => 1,
            ])
            ->addNumber('space_between', [
                'label' => __('Space between', 'sage'),
                'required' => false,
                'instructions' => __('Enter a number', 'sage'),
                'default_value' => 0,
            ])
            ->addNumber('autoplay', [
                'label' => __('Autoplay interval', 'sage'),
                'required' => false,
                'instructions' => __('In milliseconds. Set to 0 to disable', 'sage'),
                'default_value' => 0,
            ])
            ->endRepeater()
            ->endGroup();

        return $carousel->build();
    }
}
