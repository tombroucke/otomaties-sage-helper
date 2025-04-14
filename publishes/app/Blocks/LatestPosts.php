<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;
use Otomaties\AcfObjects\Fields\Number;
use Otomaties\AcfObjects\Fields\Text;

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
        $postsPerPage = AcfObjects::getField('posts_per_page')
            ->default(new Number(3))
            ->toInt();

        return [
            'latestPosts' => $this->latestPosts($postsPerPage),
            'showPagination' => AcfObjects::getField('show_pagination'),
            'archiveLink' => get_post_type_archive_link('post'),
            'columnCount' => $this->columnCount($postsPerPage),
        ];
    }

    public function columnCount($postsPerPage)
    {
        match ($postsPerPage) {
            1 => $columnCount = 1,
            2 => $columnCount = 2,
            3 => $columnCount = 3,
            4 => $columnCount = 4,
            default => $columnCount = 3,
        };

        return $columnCount;
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $latestPosts = Builder::make('latest_posts');

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

    public function latestPosts($postPerPage)
    {
        $args = [
            'posts_per_page' => $postPerPage,
            'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
        ];

        return new \WP_Query($args);
    }
}
