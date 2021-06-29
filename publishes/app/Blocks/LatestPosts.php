<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class LatestPosts extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Latest Posts';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display your latest posts';

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
        'align_text' => false,
        'align_content' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {

        return [
            'latestPosts' => $this->latestPosts(),
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
                'label' => __('Number of posts')
            ]);

        return $latestPosts->build();
    }

    public function latestPosts() {
        $args = array(
            'posts_per_page' => (string)Acf::get_field('posts_per_page')->default('3')
        );
        return new \WP_Query($args);
    }
}
