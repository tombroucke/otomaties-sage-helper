<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use Roots\Acorn\Application;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Timeline extends Block
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
    public $icon = 'sort';

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
        'align' => ['wide', 'full'],
        'align_text' => false,
        'align_content' => false,
        'mode' => true,
        'multiple' => true,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->name = __('Timeline', 'sage');
        $this->slug = 'timeline';
        $this->description = __('A timeline with events', 'sage');
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
            'items' => Acf::getField('items'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $timeline = new FieldsBuilder('timeline');

        $timeline
            ->addRepeater('items', [
                'label' => __('Items', 'sage'),
                'layout' => 'block'
            ])
                ->addImage('image', [
                    'label' => __('Image', 'sage'),
                    'preview_size' => 'thumbnail',
                ])
                ->addNumber('year', [
                    'label' => __('Year', 'sage'),
                ])
                ->addText('title', [
                    'label' => __('Title', 'sage'),
                ])
                ->addWysiwyg('content', [
                    'label' => __('Content', 'sage'),
                    'media_upload' => 0,
                ])
            ->endRepeater();

        return $timeline->build();
    }
}
