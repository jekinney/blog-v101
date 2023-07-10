<?php

return [
    'roles' => [
        ['slug' => 'admin', 'display_name' => 'Admin', 'description' => 'Site admin with full permissions.', 'can_delete' => false],
        ['slug' => 'author', 'display_name' => 'Author', 'description' => 'Author able to create articles and edit own articles.', 'can_delete' => false],
    ],
    'permissions' => [
        ['slug' => 'create_categories', 'display_name' => 'Create Categories', 'description' => 'Can create new categories.'],
        ['slug' => 'update_categories', 'display_name' => 'Update Categories', 'description' => 'Can update existing categories.'],
        ['slug' => 'remove_categories', 'display_name' => 'Remove Categories', 'description' => 'Can remove categories.'],
    ],
];
