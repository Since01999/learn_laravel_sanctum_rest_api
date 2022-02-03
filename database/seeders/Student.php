<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class Student extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(0,10) as $value){
           DB::table('students')->insert( [
                'name' => $faker->name(),
                'city' => $faker->city(),
                'fees' => $faker->randomFloat(2)
           ]);
        }
    }
}
