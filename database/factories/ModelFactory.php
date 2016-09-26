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
use App\Categoria;
use App\User;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
        'email' => $faker->safeEmail,
        //use bcrypt('password') if you want to assert for a specific password, but it might slow down your tests
        'password' => str_random(10),
    ];
});

$factory->define(App\PasswordReset::class, function (Faker\Generator $faker) {
    return [
        'email'  => $faker->safeEmail,
        'token' => str_random(10),
    ];
});

$factory->define(Categoria::class,function(Faker\Generator $faker){
    $user_ids = \DB::table('users')->select('id')->get();
    $array = [
        'categoria'=>$faker->name,
        'descripcion'=>$faker->name,
        'slug'=>$faker->slug,
        'icono'=>$faker->imageUrl,
        'user_id'=>$faker->randomElement($user_ids)->id,
    ];
    return $array;
});

$factory->define(Item::class,function(Faker\Generator $faker){
    $user_ids = \DB::table('users')->select('id')->get();
    $array = [
        'item'=>$faker->name,
        'descripcion'=>$faker->name,
        'user_id'=>$faker->randomElement($user_ids)->id,
        //'type'=>
    ];
    return $array;
});
