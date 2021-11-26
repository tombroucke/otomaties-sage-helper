<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Button extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Button';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Button';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'text';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'button';

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
        'align' => false,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => false,
        'color' => [
            'text' => false,
            'gradients' => false,
        ],
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [
        [
            'name' => 'outline',
            'label' => 'Outline',
        ],
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        $backgroundColor = property_exists($this->block, 'backgroundColor') ? $this->block->backgroundColor : 'primary';
        $outline = property_exists($this->block, 'className') && strpos($this->block->className, 'is-style-outline') !== false;
        return [
            'button' => Acf::get_field('button'),
            'theme' => $outline ? 'outline-' . $backgroundColor : $backgroundColor,
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $button = new FieldsBuilder('button');

        $button
            ->addLink('button', [
                'label' => __('Button', 'sage')
            ]);

        return $button->build();
    }
}
