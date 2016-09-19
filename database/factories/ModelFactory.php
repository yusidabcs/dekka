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

$factory->define(App\UserMongo::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\NewsMongo::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->firstName,
        'content' => $faker->lastName,
        'url' => $faker->safeEmail,
        'image' => bcrypt(str_random(10)),
    ];
});
