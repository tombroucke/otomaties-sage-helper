<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Location extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Location';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Location block.';

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
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'location' => Acf::get_field('location'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $location = new FieldsBuilder('location');

        $location
            ->addGoogleMap('location', [
                'label' => __('Location', 'sage')
            ]);

        return $location->build();
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        wp_enqueue_script('sage/block/location', asset('scripts/blocks/location.js')->uri(), ['jquery'], null, true);
    }
}
