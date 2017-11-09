<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/*
 * The hackModel faker method to test the POST data.
 */
$factory->define(App\hackModel::class,function (Faker\Generator $faker) {
    return [
        'category' => $faker->lastName,
        'place' => $faker->streetAddress,
        'officer' => $faker->name,
        'service' => $faker->firstName,
        'case' => $faker->text,
        'userid' => \Illuminate\Support\Facades\Auth::user()->id,
        'proof' => $faker->boolean(0),
        'anonymous' => $faker->boolean('80'),
        'remember_token'=>str_random(10)
    ];
});