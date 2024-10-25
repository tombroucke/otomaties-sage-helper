<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Buttons extends Block
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
        'align' => ['wide'],
        'align_text' => true,
        'align_content' => false,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
        'jsx' => false,
    ];

    /**
     * Set title, description & slug, allow for translation
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Buttons', 'sage');
        $this->slug = 'buttons';
        $this->description = __('Display multiple buttons', 'sage');
        parent::__construct($composer);
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'buttons' => Acf::getField('buttons'),
            'settings' => Acf::getField('settings'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $themeJson = json_decode(file_get_contents(app()->basePath('theme.json')), true);
        $themes = [];
        if (isset($themeJson['settings']['color']['palette'])) {
            foreach ($themeJson['settings']['color']['palette'] as $themeColor) {
                $themeName = $themeColor['name'];
                $themeSlug = $themeColor['slug'];
                $themes[$themeSlug] = $themeName;
                $themes['outline-'.$themeSlug] = sprintf('%s %s', $themeName, __('outline', 'sage'));
            }
        }

        $buttons = new FieldsBuilder('buttons');
        $buttons
            ->addRepeater('buttons', [
                'label' => __('Buttons', 'sage'),
            ])
            ->addLink('button', [
                'label' => __('Button', 'sage'),
            ])
            ->addSelect('theme', [
                'label' => __('Theme', 'sage'),
                'choices' => $themes,
                'default_value' => array_key_first($themes),
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

    public function render($block, $content = '', $preview = false, $post_id = 0, $wp_block = false, $context = false)
    {
        $justifyMapping = [
            'center' => 'center',
            'right' => 'end',
            'left' => 'start',
        ];
        $block['justify_content'] = isset($block['align_text']) && $block['align_text'] ? $justifyMapping[$block['align_text']] : 'start';
        $block['align_text'] = null;

        return parent::render($block, $content, $preview, $post_id, $wp_block, $context);
    }
}
