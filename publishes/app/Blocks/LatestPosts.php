<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class LatestPosts extends Block
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
    public $icon = 'admin-post';

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
    public $align = 'wide';

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
        'align_text' => false,
        'align_content' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param AcfComposer $composer
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Latest Posts', 'sage');
        $this->slug = 'latest-posts';
        $this->description = __('Display your latest posts', 'sage');
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
            'latestPosts' => $this->latestPosts(),
            'showPagination' => Acf::getField('show_pagination'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $latestPosts = new FieldsBuilder('latest_posts');

        $latestPosts
            ->addNumber('posts_per_page', [
                'label' => __('Number of posts', 'sage'),
                'default_value' => 3,
                'instructions' => __('-1 for all posts', 'sage'),
            ])
            ->addTrueFalse('show_pagination', [
                'label' => __('Show pagination', 'sage'),
                'default_value' => false,
            ]);

        return $latestPosts->build();
    }

    public function latestPosts()
    {
        $args = array(
            'posts_per_page' => (string)Acf::getField('posts_per_page')->default('3'),
            'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
        );
        return new \WP_Query($args);
    }
}
