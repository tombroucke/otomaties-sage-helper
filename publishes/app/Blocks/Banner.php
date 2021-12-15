<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use Roots\Acorn\Application;
use StoutLogic\AcfBuilder\FieldsBuilder;

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
        'align_content' => false,
        'anchor' => true,
        'mode' => false,
        'multiple' => true,
        'jsx' => false,
        'color' => true,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->name = __('Banner', 'sage');
        $this->slug = 'banner';
        $this->description = __('Display a banner', 'sage');
        parent::__construct($app);
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        $backgroundColor = property_exists($this->block, 'backgroundColor') ? 'bg-' . $this->block->backgroundColor : null;
        $textColor = property_exists($this->block, 'textColor') ? 'text-' . $this->block->textColor : null;

        return [
            'backgroundImage' => Acf::get_field('background_image'),
            'title' => Acf::get_field('title')->default(get_the_title()),
            'backgroundColor' => $backgroundColor,
            'textColor' => $textColor,
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $banner = new FieldsBuilder('banner');

        $banner
            ->addText('title', [
                'label' => __('Title', 'sage'),
                'instructions' => __('Defaults to post title', 'sage')
            ])
            ->addImage('background_image', [
                'label' => __('Background image', 'sage'),
                'required' => true
            ]);

        return $banner->build();
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        //
    }
}
