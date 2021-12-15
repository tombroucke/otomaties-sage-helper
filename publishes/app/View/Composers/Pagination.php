<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Pagination extends Composer
{
    /**
    * List of views served by this composer.
    *
    * @var array
    */
    protected static $views = [
        'partials.pagination',
    ];

    /**
    * Data to be passed to view before rendering.
    *
    * @return array
    */
    public function with()
    {
        return [
            'pages' => $this->pages(),
        ];
    }

    public function pages()
    {
        $wp_query = $this->data->get('wpQuery');
        $addFragment = $this->data->get('addFragment');

        if (!$wp_query) {
            global $wp_query;
        }

        $pages = (array)paginate_links([
            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format'       => '?paged=%#%',
            'current'      => max(1, get_query_var('paged')),
            'total'        => $wp_query->max_num_pages,
            'show_all'     => false,
            'end_size'     => 3,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => __('Previous', 'sage'),
            'next_text'    => __('Next', 'sage'),
            'add_args'     => false,
            'add_fragment' => $addFragment,
            'type'         => 'array',
        ]);

        array_walk($pages, function (&$page) {
            $page = array(
                'active' => strpos($page, 'current'),
                'link'   => str_replace('page-numbers', 'page-link', $page)
            );
        });
        return $pages;
    }
}
