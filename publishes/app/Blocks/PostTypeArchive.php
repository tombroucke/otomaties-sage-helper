<?php

namespace App\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

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
     *
     * @param AcfComposer $composer
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
            // TODO: add custom post types. It is too soon to call get_post_types()
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
            'post_type' => (string)Acf::getField('settings')->get('post_type')->default('post'),
            'posts_per_page' => (string)Acf::getField('settings')->get('posts_per_page')->default('-1'),
            'post__not_in' => array(get_the_ID()),
            'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
        ];
        return new \WP_Query($args);
    }
}
