<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Cards extends Block
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
        'align' => ['full', 'wide'],
        'align_text' => true,
        'align_content' => false,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param AcfComposer $composer
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Cards', 'sage');
        $this->slug = 'cards';
        $this->description = __('Show multiple cards next to eachother', 'sage');
        parent::__construct($composer);
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        $columns = Acf::getField('settings')->get('columns') ?: 3;
        return [
            'cards' => Acf::getField('cards'),
            'columns' => $columns,
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
            ->endRepeater()
            ->addGroup('settings', [
                'label' => __('Settings', 'sage')
            ])
                ->addNumber('columns', [
                    'label' => __('Columns', 'sage'),
                    'default_value' => 3,
                    'max' => 6,
                    'instructions' => __('Max. 6', 'sage'),
                ])
            ->endGroup();

        return $cards->build();
    }
}
