<?php

return [
    'defaults' => [
        'fieldGroup' => ['instruction_placement' => 'acfe_instructions_tooltip'],
        'repeater' => ['layout' => 'block', 'acfe_repeater_stylised_button' => 1],
        'trueFalse' => ['ui' => 1],
        'select' => ['ui' => 1],
        'postObject' => ['ui' => 1, 'return_format' => 'object'],
        'accordion' => ['multi_expand' => 1],
        'group' => ['layout' => 'table', 'acfe_group_modal' => 1],
        'tab' => ['placement' => 'left'],
        'sidebar_selector' => ['default_value' => 'sidebar-primary', 'allow_null' => 1]
    ],
];
