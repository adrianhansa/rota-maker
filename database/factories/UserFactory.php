<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'admin'=>1,
        'company_id'=>0,
        'house_slug'=>'',
        'house_id'=>0,
    ];
});

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address
    ];
});

$factory->define(App\House::class, function (Faker $faker) {
	$name = $faker->company;
    return [
        'name' => $name,
        'slug'=> str_slug($name),
        'address' => $faker->address
    ];
});

$factory->define(App\Employee::class, function (Faker $faker) {
	$name = $faker->name;
    return [
        'name' => $name,
        'slug'=> str_slug($name),
        'email' => $faker->unique()->safeEmail,
        'position' => '',
        'medi_trained'=>$faker->randomElement([0,1]),
        'driver'=>$faker->randomElement([0,1]),
        'can_run_shifts'=>$faker->randomElement([0,1]),
        'contracted_hours'=>$faker->randomElement([35,37.5,42]),
        'gender'=>$faker->randomElement(['male','female'])
    ];
});

$factory->define(App\Shift::class, function (Faker $faker) {
	$name = $faker->company;
    return [
        'name' => '',
        'start'=> 0,
        'end' => 0,
        'duration'=>0,
    ];
});

