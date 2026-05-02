<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

 'guards' => [

    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],

    'partner' => [
        'driver' => 'session',
        'provider' => 'partners',
    ],

    'student' => [
        'driver' => 'session',
        'provider' => 'students',
    ],
],

'providers' => [

    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],

    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],

    'partners' => [
        'driver' => 'eloquent',
        'model' => App\Models\Partner::class,
    ],

    'students' => [
        'driver' => 'eloquent',
        'model' => App\Models\Student::class,
    ],
],
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];