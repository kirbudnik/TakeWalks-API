<?php // database/factories/UserFactory.php $factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name'                  => 'API user'
        'email'                 => 'admins@walks.org',
        'password'              => \Illuminate\Support\Facades\Hash::make('test-password'),

    ];
});