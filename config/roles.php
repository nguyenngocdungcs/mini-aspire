<?php

return [
    'names' => [
        App\User::ROLE_ADMIN => 'Admin',
        App\User::ROLE_USER => 'User',

    ],

    'permissions' => [
        App\User::ROLE_ADMIN => null, // Null mean full access
        App\User::ROLE_USER => []
    ],

    'none_authorize_actions' => [
        'home',
        'password.*'
    ]
];