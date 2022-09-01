<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use Roots\Acorn\Application;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Logos extends Block
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
        'align' => ['full', 'wide'],
        'align_text' => false,
        'align_content' => false,
        'anchor' => true,
        'mode' => false,
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
        $this->name = __('Logos', 'sage');
        $this->slug = 'logos';
        $this->description = __('Show logos in a carousel or grid', 'sage');
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
            'logos' => Acf::getField('logos'),
            'type' => Acf::getField('type'),
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
