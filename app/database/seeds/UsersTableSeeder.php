<?php

use CookBook\Accounts\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker::create();

    foreach(range(1, 10) as $index)
    {
      User::create([
        'email' => $faker->unique()->email(),
        'username' => $faker->unique()->userName(),
        'password' => 'password',
      ]);
    }
  }

}
