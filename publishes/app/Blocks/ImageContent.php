<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use Roots\Acorn\Application;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ImageContent extends Block
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
    public $icon = 'align-pull-left';

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
        'jsx' => true,
        'color' => true,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->name = __('Image & Content', 'sage');
        $this->slug = 'image-content';
        $this->description = __('Content next to an image', 'sage');
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
            'image' => Acf::get_field('image')->default('https://picsum.photos/500/500'),
            'imagePosition' => Acf::get_field('settings')->get('image_position')->default('left'),
            'imageSize' => $this->block->align == 'full' || $this->block->align == 'wide' ? 'large' : 'medium',
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
        $imageContent = new FieldsBuilder('image_content');

        $imageContent
            ->addImage('image', [
                'label' => __('Image', 'sage'),
                'required' => true,
            ])
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
            ])
                ->addSelect('image_position', [
                    'label' => __('Image position', 'sage'),
                    'allow_null' => true,
                    'choices' => [
                        'left' => __('Left', 'sage'),
                        'right' => __('Right', 'sage'),
                    ],
                ])
            ->endGroup();

        return $imageContent->build();
    }
}
