<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;

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
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        $settings = AcfObjects::getField('settings')
            ->default([
                'ratio' => '6:6',
                'image_position' => 'left',
                'stretch_image' => 'false',
            ]);
        $ratio = $settings->get('ratio');
        $imagePosition = $settings->get('image_position');

        $verticalAlign = match ($this->block->alignContent ?? 'top') {
            'center' => 'center',
            'top' => 'start',
            'bottom' => 'end',
            default => 'start',
        };

        $hasBackgroundColor = isset($this->block->backgroundColor);

        return [
            'verticalAlign' => $verticalAlign,
            'image' => AcfObjects::getField('image'),
            'imageGridColumn' => $this->gridColumn(true, $ratio, $imagePosition, $this->block->align, $hasBackgroundColor),
            'contentGridColumn' => $this->gridColumn(false, $ratio, $imagePosition, $this->block->align, $hasBackgroundColor),
            'imageClasses' => $settings->get('stretch_image') ? ['h-100', 'object-fit-cover'] : [],
            'stretchImage' => $settings->get('stretch_image'),
        ];
    }

    private function gridColumn($isImage, $ratio, $imagePosition = 'left', $align = 'none', $hasBackgroundColor = false)
    {
        $columnWidths = explode(':', $ratio);

        if ($isImage) {
            if ($imagePosition == 'left') {
                $span = $align === 'full' ? $columnWidths[0] + 1 : $columnWidths[0];
                $start = 1;
            } else {
                $span = $align === 'full' ? $columnWidths[1] + 1 : $columnWidths[1];
                $start = -$span - 1;
            }
        } else {
            if ($imagePosition == 'right') {
                $span = $align === 'full' ? $columnWidths[0] - 1 : $columnWidths[0] - 2;
                $start = $hasBackgroundColor || $align === 'full' ? 2 : 1;
            } else {
                $span = $align === 'full' ? $columnWidths[1] - 1 : $columnWidths[1] - 2;
                $start = $align === 'full' ? -$span - 2 : -$span - 2;
            }
        }

        return $start.' / span '.$span;
    }

    private function columnPossibilities()
    {
        return [
            '4:8',
            '4:7',
            '4:6',
            '4:5',
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
        ];
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
                'choices' => $this->columnPossibilities(),
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
