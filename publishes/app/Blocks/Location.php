<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;

class Location extends Block
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
    public $icon = 'location-alt';

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
    public $mode = 'edit';

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
        'mode' => false,
        'multiple' => true,
    ];

    /**
     * Set title, description & slug, allow for translation
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Location', 'sage');
        $this->slug = 'location';
        $this->description = __('Show a location on a map', 'sage');
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
            'locationType' => AcfObjects::getField('location_type')->default('iframe')->toString(),
            'iframe' => AcfObjects::getField('iframe'),
            'location' => AcfObjects::getField('location'),
            'info' => AcfObjects::getField('info'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $location = Builder::make('location');

        $location
            ->addSelect('location_type', [
                'label' => __('Location type', 'sage'),
                'choices' => [
                    'iframe' => __('Iframe', 'sage'),
                    'map' => __('Map', 'sage'),
                ],
                'default_value' => 'iframe',
            ])
            ->addTextarea('iframe', [
                'label' => __('Iframe', 'sage'),
                'instructions' => __('Paste the iframe code here.', 'sage'),
                'rows' => 5,
                'required' => false,
                'placeholder' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d..."></iframe>',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'location_type',
                            'operator' => '==',
                            'value' => 'iframe',
                        ],
                    ],
                ],
            ])
            ->addGoogleMap('location', [
                'label' => __('Location', 'sage'),
                'instructions' => __('Select a location on the map.', 'sage'),
                'required' => false,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'location_type',
                            'operator' => '==',
                            'value' => 'map',
                        ],
                    ],
                ],
            ])
            ->addWysiwyg('info', [
                'label' => __('Extra information', 'sage'),
                'required' => false,
                'instructions' => __('This will be showed after clicking the marker.', 'sage'),
                'media_upload' => false,
                'toolbar' => 'basic',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'location_type',
                            'operator' => '==',
                            'value' => 'map',
                        ],
                    ],
                ],
            ]);

        return $location->build();
    }
}
