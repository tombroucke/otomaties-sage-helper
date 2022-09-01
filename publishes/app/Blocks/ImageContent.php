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
        'align_content' => true,
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
        return [
            'image' => Acf::getField('image')->default('https://picsum.photos/500/500'),
            'imagePosition' => Acf::getField('settings')->get('image_position')->default('left'),
            'imageSize' => $this->block->align == 'full' || $this->block->align == 'wide' ? 'large' : 'medium',
            'verticalAlignClass' => $this->verticalAlignClass(),
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

    public function verticalAlignClass()
    {
        $class = '';
        switch ($this->block->align_content) {
            case 'center':
                $class = 'align-items-center';
                break;
            case 'top':
                $class = 'align-items-start';
                break;
            case 'bottom':
                $class = 'align-items-end';
                break;
        }
        return $class;
    }
}
