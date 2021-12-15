<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use Roots\Acorn\Application;
use StoutLogic\AcfBuilder\FieldsBuilder;
use function Roots\asset;

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
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->name = __('Location', 'sage');
        $this->slug = 'location';
        $this->description = __('Show a location on a map', 'sage');
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
        wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key=' . getenv('GOOGLE_MAPS_API_KEY'), ['jquery'], null, true);
        wp_enqueue_script('sage/block/location', asset('scripts/blocks/location.js')->uri(), ['jquery', 'google-maps'], null, true);
    }
}
