<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Facades\AcfObjects;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Locations extends Block
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
        $this->name = __('Locations', 'sage');
        $this->slug = 'locations';
        $this->description = __('Show multiple locations on a map', 'sage');
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
            'locations' => AcfObjects::getField('locations'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $locations = new FieldsBuilder('locations');

        $locations
            ->addRepeater('locations', [
                'label' => __('Locations', 'sage'),
                'layout' => 'block',
                'button_label' => __('Add Item', 'sage'),
            ])
            ->addGoogleMap('location', [
                'label' => __('Location', 'sage'),
            ])
            ->addWysiwyg('info', [
                'label' => __('Extra information', 'sage'),
                'required' => false,
                'instructions' => __('This will be showed after clicking the marker.', 'sage'),
                'media_upload' => false,
                'toolbar' => 'basic',
            ])
            ->endRepeater();

        return $locations->build();
    }
}
