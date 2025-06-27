<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;
use Otomaties\AcfObjects\Fields\Select;

class ImageContent extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Image Content';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Image Content block.';

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
    public $icon = 'editor-ul';

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
     * The ancestor block type allow list.
     *
     * @var array
     */
    public $ancestor = [];

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
        'align' => ['wide', 'full'],
        'align_text' => false,
        'align_content' => true,
        'full_height' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => true,
        'color' => [
            'background' => true,
        ],
    ];

    /**
     * The block template.
     *
     * @var array
     */
    public $template = [
        'core/heading' => [
            'level' => 2,
            'placeholder' => 'Lorem ipsum dolor sit amet',
        ],
        'core/paragraph' => [
            'placeholder' => 'Consectetur mollit occaecat enim veniam anim. Commodo exercitation voluptate magna fugiat dolore sit labore proident enim Lorem officia et quis',
        ],
    ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        $settings = AcfObjects::getField('settings')
            ->default([
                'ratio' => new Select('6:6'),
                'image_position' => new Select('left'),
                'stretch_image' => false,
            ]);

        $ratio = $settings->get('ratio');
        $imagePosition = $settings->get('image_position');

        $verticalAlign = match ($this->block->alignContent ?? 'top') {
            'center' => 'center',
            'top' => 'start',
            'bottom' => 'end',
            default => 'start',
        };

        $alignFull = $this->block->align === 'full';

        $imageGridColumn = $this->gridColumn(true, $ratio, $imagePosition, $alignFull);
        $contentGridColumn = $this->gridColumn(false, $ratio, $imagePosition, $alignFull);

        return [
            'verticalAlign' => $verticalAlign,
            'image' => AcfObjects::getField('image'),
            'imageStyles' => 'grid-column: '.$imageGridColumn.'; grid-row: 1;',
            'contentStyles' => 'grid-column: '.$contentGridColumn.'; grid-row: 1;',
            'imageClasses' => $settings->get('stretch_image') ? ['h-100', 'object-fit-cover'] : [],
            'stretchImage' => $settings->get('stretch_image'),
            'hasBackgroundColor' => isset($this->block->backgroundColor),
            'imagePosition' => $imagePosition,
        ];
    }

    private function gridColumn($isImage, $ratio, $imagePosition = 'left', $alignFull = false)
    {
        $columnWidths = explode(':', $ratio);

        if ($isImage) {
            if ($imagePosition == 'left') {
                $span = $alignFull ? $columnWidths[0] + 1 : $columnWidths[0];
                $start = 1;
            } else {
                $span = $alignFull ? $columnWidths[1] + 1 : $columnWidths[1];
                $start = -$span - 1;
            }
        } else {
            if ($imagePosition == 'left') {
                $span = $columnWidths[1];
                $start = $alignFull ? -$span - 2 : -$span - 1;
            } else {
                $span = $columnWidths[0];
                $start = $alignFull ? 2 : 1;
            }
        }

        return $start.' / span '.$span;
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('image_content');

        $fields
            ->addImage('image', [
                'label' => __('Image', 'sage'),
                'required' => true,
                'preview_size' => 'thumbnail',
                'instructions' => __('Upload an image', 'sage'),
            ])
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
                'layout' => 'block',
            ])
            ->addSelect('image_position', [
                'label' => __('Image Position', 'sage'),
                'allow_null' => true,
                'choices' => [
                    'left' => __('Left', 'sage'),
                    'right' => __('Right', 'sage'),
                ],
            ])
            ->addSelect('ratio', [
                'label' => __('Ratio', 'sage'),
                'allow_null' => true,
                'choices' => [
                    '4:8',
                    '4:7',
                    '4:6',
                    '4:5',
                    '4:4',
                    '5:7',
                    '5:6',
                    '5:5',
                    '6:6',
                    '6:5',
                    '7:5',
                    '5:4',
                    '6:4',
                    '7:4',
                    '8:4',
                ],
                'default_value' => '6:6',
                'instructions' => __('The ratio of the image and the content. There are a total of 12 columns.', 'sage'),
            ])
            ->addTrueFalse('stretch_image', [
                'label' => __('Stretch Image', 'sage'),
                'instructions' => __('Stretch the image to the full height of the block', 'sage'),
                'default_value' => false,
            ])
            ->endGroup();

        return $fields->build();
    }
}
