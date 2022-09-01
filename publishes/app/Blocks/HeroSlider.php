<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use Roots\Acorn\Application;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeroSlider extends Block
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
    public $icon = 'desktop';

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
    public $align = 'full';

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
        'align' => array('full', 'wide'),
        'align_text' => true,
        'align_content' => false,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->name = __('Hero slider', 'sage');
        $this->slug = 'hero-slider';
        $this->description = __('Display a hero with slides on top of your page', 'sage');
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
            'items' => Acf::getField('items'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $heroSlider = new FieldsBuilder('hero_slider');

        $heroSlider
            ->addRepeater('items', [
                'label' => __('Items', 'sage'),
                'layout' => 'block',
            ])
                ->addImage('background_image', [
                    'label' => __('Background image', 'sage'),
                    'required' => true
                ])
                ->addText('title', [
                    'label' => __('Title', 'sage')
                ])
                ->addText('subtitle', [
                    'label' => __('Subtitle', 'sage')
                ])
                ->addRepeater('buttons', [
                    'label' => __('Buttons', 'sage'),
                ])
                    ->addLink('button', [
                        'label' => __('Button', 'sage'),
                    ])
                    ->addSelect('theme', [
                        'label' => __('Theme', 'sage'),
                        'choices' => $this->themeColors(),
                        'default_value' => array_key_first($this->themeColors())
                    ])
                ->endRepeater()
                ->addGroup('settings', [
                    'label' => __('Settings', 'sage'),
                    'layout' => 'block',
                ])
                    ->addSelect('text_color', [
                        'label' => __('Text color', 'sage'),
                        'allow_null' => true,
                        'choices' => $this->themeColors(false),
                        'default_value' => array_key_first($this->themeColors(false))
                    ])
                    ->addTrueFalse('group_buttons', [
                        'label' => __('Group buttons', 'sage'),
                        'message' => __('Show buttons as a group', 'sage'),
                        'default_value' => false,
                    ])
                    ->addSelect('content_position', [
                        'label' => __('Content position', 'sage'),
                        'choices' => [
                            'left' => __('Left', 'sage'),
                            'right' => __('Right', 'sage'),
                        ],
                    ])
                ->endGroup()
            ->endRepeater();

        return $heroSlider->build();
    }

    public function themeColors(bool $outline = true)
    {
        $themeJson = json_decode(file_get_contents(app()->basePath('theme.json')), true);
        $themes = [];
        if (isset($themeJson['settings']['color']['palette'])) {
            foreach ($themeJson['settings']['color']['palette'] as $themeColor) {
                $themeName = $themeColor['name'];
                $themeSlug = $themeColor['slug'];
                $themes[$themeSlug] = $themeName;
                if ($outline) {
                    $themes['outline-' . $themeSlug] = sprintf('%s %s', $themeName, __('outline', 'sage'));
                }
            }
        }
        return $themes;
    }
}
