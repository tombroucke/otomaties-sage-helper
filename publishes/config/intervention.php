<?php
return [
    'wp-admin' => [
        'editor|shop_manager' => [
            'common' => [
                'adminbar' => [
                    'comments' => false,
                    'search' => false,
                    'updates' => false,
                    'site' => [
                        'themes' => false
                    ]
                ],
                'updates' => false,
            ],
            'comments' => true,
            'dashboard' => 'pages',
            'tools' => true,
        ]
    ],
    'application' => [
        'theme' => 'themename',
        'plugins' => [
            'advanced-custom-fields-pro/acf.php' => true,
        ],
        'general' => [
            'membership' => false,
            'language' => 'nl_NL',
            'default-role' => 'subscriber',
            'timezone' => 'Europe/Brussels',
            'date-format' => 'j F Y',
            'time-format' => 'H:i',
            'week-starts' => 'Mon',
        ],
        'writing' => [
            'emoji' => 'false',
        ],
        'reading' => [
            'posts-per-page' => 10,
            'posts-per-rss' => 10,
            'rss-excerpt' => 'full',
        ],
        'media' => [
            'sizes' => [
                'thumbnail' => [
                    'width' => 300,
                    'height' => 200,
                    'crop' => true,
                ],
                'medium' => [
                    'width' => 800,
                    'height' => 800,
                    'crop' => false,
                ],
                'large' => [
                    'width' => 1920,
                    'height' => 1920,
                    'crop' => true,
                ],
            ],
            'uploads.organize' => true,
        ],
        'permalinks' => [
            'structure' => '/%postname%/',
            'category-base' => 'category',
            'tag-base' => 'tag',
            'search-base' => 'search',
        ],
    ],
];
