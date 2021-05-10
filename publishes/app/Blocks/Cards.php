<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Cards extends Block
{

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Cards';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Cards block.';

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
    public $icon = 'screenoptions';

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
        'align' => false,
        'align_text' => false,
        'align_content' => false,
        'anchor' => false,
        'mode' => true,
        'multiple' => true,
        'jsx' => false,
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'cards' => Acf::get_field('cards'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $cards = new FieldsBuilder('cards');

        $cards
            ->addRepeater('cards', [
                'label' => __('Cards', 'sage'),
                'layout' => 'block',
            ])
                ->addImage('image', [
                    'label' => __('Image', 'sage'),
                ])
                ->addText('title', [
                    'label' => __('Title', 'sage'),
                ])
                ->addWysiwyg('content', [
                    'label' => __('Content', 'sage'),
                ])
                ->addLink('button', [
                    'label' => __('Button', 'sage'),
                ])
            ->endRepeater();

        return $cards->build();
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
