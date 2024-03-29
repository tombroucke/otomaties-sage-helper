<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use App\Blocks\Concerns\VerticalAlign;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ImageContent extends Block
{
    use VerticalAlign;

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
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
        'color' => true,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param AcfComposer $composer
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Image & Content', 'sage');
        $this->slug = 'image-content';
        $this->description = __('Content next to an image', 'sage');
        parent::__construct($composer);
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        $ratio = Acf::getField('settings')->get('ratio')->default('6:6');
        $imagePosition = Acf::getField('settings')->get('image_position')->default('left');

        return [
            'image' => Acf::getField('image')->default('https://picsum.photos/630/472'),
            'imagePosition' => $imagePosition,
            'imageSize' => $this->block->align == 'full' || $this->block->align == 'wide' ? 'large' : 'medium',
            'firstColumnClasses' => $this->columnClasses(1, $ratio, $imagePosition),
            'secondColumnClasses' => $this->columnClasses(2, $ratio, $imagePosition),
            'verticalAlignClass' => $this->verticalAlignClass(),
        ];
    }

    public function columnClasses($index, $ratio, $imagePosition)
    {
        if ($imagePosition == 'left') {
            $ratio = strrev($ratio);
        }
        $columns = explode(':', $ratio);
        return 'col-md-' . $columns[--$index];
    }

    public function columnPossibilities()
    {
        return [
            '4:8',
            '4:7',
            '5:7',
            '5:6',
            '6:6',
            '6:5',
            '7:5',
            '7:4',
            '8:4',
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
                'layout' => 'block',
            ])
                ->addSelect('image_position', [
                    'label' => __('Image position', 'sage'),
                    'allow_null' => true,
                    'choices' => [
                        'left' => __('Left', 'sage'),
                        'right' => __('Right', 'sage'),
                    ],
                ])
                ->addSelect('ratio', [
                    'label' => __('Ratio', 'sage'),
                    'allow_null' => true,
                    'choices' => $this->columnPossibilities(),
                    'default_value' => '6:6',
                    'instructions' => __('The ratio of the image and the content. There are a total of 12 columns.', 'sage'),
                ])
            ->endGroup();

        return $imageContent->build();
    }
}
