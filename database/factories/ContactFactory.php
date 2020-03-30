<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use App\User;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'name'      => $faker->name,
        'email'     => $faker->email,
        'birthday'  => '12/29/1978',
        'company'   => $faker->company,
        'user_id'   => factory(User::class)
    ];
});
