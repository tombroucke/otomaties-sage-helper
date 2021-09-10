<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Buttons extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Buttons';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Buttons block.';

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
        'align' => true,
        'align_text' => true,
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
            'align' => $this->align,
            'buttons' => Acf::get_field('buttons'),
            'settings' => Acf::get_field('settings'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $buttons = new FieldsBuilder('buttons');
        $buttons
            ->addRepeater('buttons', [
                'label' => __('Buttons', 'sage')
            ])
                ->addLink('button', [
                    'label' => __('Button', 'sage')
                ])
                ->addSelect('style', [
                    'label' => __('Style', 'sage'),
                    'choices' => array(
                        'primary' => __('Primary', 'sage'),
                        'secondary' => __('Secondary', 'sage'),
                        'success' => __('Success', 'sage'),
                        'danger' => __('Danger', 'sage'),
                        'warning' => __('Warning', 'sage'),
                        'info' => __('Info', 'sage'),
                        'light' => __('Light', 'sage'),
                        'dark' => __('Dark', 'sage'),
                        'white' => __('White', 'sage'),
                    ),
                    'default_value' => 'primary',
                ])
            ->endRepeater()
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
            ])
                ->addTrueFalse('group', [
                    'label' => __('Group buttons', 'sage'),
                    'message' => __('Show buttons as a group', 'sage'),
                    'default_value' => false,
                ])
            ->endGroup();

        return $buttons->build();
    }
}
