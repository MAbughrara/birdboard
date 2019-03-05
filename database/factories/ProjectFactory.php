<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'description'=>$faker->paragraph,
        'owner_id'=> function()
        {
            factory(\App\User::class)->create()->id;
        }
    ];
});
