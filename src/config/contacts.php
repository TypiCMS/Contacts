<?php

declare(strict_types=1);

return [
    'linkable_to_page' => true,
    'per_page' => 50,
    'order' => [
        'id' => 'desc',
    ],
    'sidebar' => [
        'icon' => '<i class="icon-user"></i>',
        'weight' => 3,
    ],
    'permissions' => [
        'read contacts' => 'Read',
        'create contacts' => 'Create',
        'update contacts' => 'Update',
        'delete contacts' => 'Delete',
    ],
];
