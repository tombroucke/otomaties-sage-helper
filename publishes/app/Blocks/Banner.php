<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;

class Banner extends Block
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
    public $icon = 'cover-image';

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
        'align' => ['full', 'wide'],
        'align_text' => true,
        'align_content' => true,
        'anchor' => true,
        'mode' => false,
        'multiple' => true,
        'jsx' => false,
        'color' => [
            'background' => true,
            'text' => false,
        ],
    ];

    /**
     * Set title, description & slug, allow for translation
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Banner', 'sage');
        $this->slug = 'banner';
        $this->description = __('Display a banner', 'sage');
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
            'backgroundImage' => AcfObjects::getField('background_image'),
            'title' => AcfObjects::getField('title')->default(get_the_title()),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $banner = Builder::make('banner');

        $banner
            ->addText('title', [
                'label' => __('Title', 'sage'),
                'instructions' => __('Defaults to post title', 'sage'),
            ])
            ->addImage('background_image', [
                'label' => __('Background image', 'sage'),
            ]);

        return $banner->build();
    }
}
