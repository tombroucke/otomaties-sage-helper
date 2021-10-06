<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostTypeArchive extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Post Type Archive';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display a list of posts';

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
        'anchor' => false,
        'mode' => false,
        'multiple' => false,
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'postTypeQuery' => $this->postTypeQuery(),
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
            // TODO: add custom post types
        ];

        $postTypeArchive = new FieldsBuilder('post_type_archive');

        $postTypeArchive
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
            ])
                ->addNumber('posts_per_page', [
                    'label' => __('Posts per page', 'sage'),
                    'default' => 'post'
                ])
                ->addSelect('post_type', [
                    'label' => __('Post type', 'sage'),
                    'default' => 'post',
                    'choices' => $postTypes
                ])
            ->endGroup();

        return $postTypeArchive->build();
    }

    private function postTypeQuery() {
        $args = [
            'post_type' => (string)Acf::get_field('settings')->get('post_type')->default('post'),
            'posts_per_page' => (string)Acf::get_field('settings')->get('posts_per_page')->default('-1'),
            'post__not_in' => array(get_the_ID()),
            'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
        ];
        return new \WP_Query($args);
    }
}
