<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;
use Otomaties\AcfObjects\Fields\Number;
use Otomaties\AcfObjects\Fields\Text;

class PostTypeArchive extends Block
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
    public $post_types = ['page'];

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
        'anchor' => true,
        'mode' => false,
        'multiple' => false,
    ];

    /**
     * Set title, description & slug, allow for translation
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Post Type Archive', 'sage');
        $this->slug = 'post-type-archive';
        $this->description = __('Display a list of posts', 'sage');
        parent::__construct($composer);
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        $settings = AcfObjects::getField('settings')
            ->default([
                'post_type' => new Text('post'),
                'posts_per_page' => new Number(5),
            ]);

        return [
            'postTypeQuery' => $this->postTypeQuery($settings),
            'columnCount' => $this->columnCount($settings->get('posts_per_page')->toInt()),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $postTypes = [
            'post' => __('Posts'),
            // TODO: add custom post types. It is too soon to call get_post_types()
        ];

        $postTypeArchive = Builder::make('post_type_archive');

        $postTypeArchive
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
            ])
            ->addNumber('posts_per_page', [
                'label' => __('Posts per page', 'sage'),
                'default' => 'post',
            ])
            ->addSelect('post_type', [
                'label' => __('Post type', 'sage'),
                'default' => 'post',
                'choices' => $postTypes,
            ])
            ->endGroup();

        return $postTypeArchive->build();
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

    private function postTypeQuery($settings)
    {
        $args = [
            'post_type' => $settings->get('post_type')->toString(),
            'posts_per_page' => $settings->get('posts_per_page')->toString(),
            'post__not_in' => [get_the_ID()],
            'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
        ];

        return new \WP_Query($args);
    }
}
