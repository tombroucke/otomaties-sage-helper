<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use Roots\Acorn\Application;
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
        'jsx' => false,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->name = __('Cards', 'sage');
        $this->slug = 'cards';
        $this->description = __('Show multiple cards next to eachother', 'sage');
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
}
