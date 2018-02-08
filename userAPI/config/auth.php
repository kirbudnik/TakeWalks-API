<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'apiUsers',
    ],

    'guards' => [
        'api' => [
            'driver' => 'passport',
            'provider' => 'apiUsers',
        ],
    ],

    'providers' => [
        'apiUsers' => [
            'driver' => 'eloquent',
            'model' => \App\Models\ApiUser::class
        ]
    ]
];