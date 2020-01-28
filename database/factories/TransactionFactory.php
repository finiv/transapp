<?php

use Faker\Generator as Faker;
use App\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Transaction::class, function (Faker $faker) {
    $types = [
        \App\Enum\TransactionTypeEnum::DEBIT,
        \App\Enum\TransactionTypeEnum::CREDIT
    ];

    return [
        'user_id' => User::all()->random()->id,
        'amount' => random_int(0, 5000),
        'type' => array_rand($types),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
