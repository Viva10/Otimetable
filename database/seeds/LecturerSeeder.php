<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LecturerSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            $faker = Faker\Factory::create();

            $limit = 100;

            for ($i = 0; $i < $limit; $i++) {
                DB::table('lecturers')->insert([ //,
                    'lecturer_name' => $faker->name,
                    'status' => $faker->boolean($chanceOfGettingTrue = 80),
                    'gender' => $faker->word,
                    'email' => $faker->unique()->email,
                    'contact' => $faker->phoneNumber,
                    
                ]);
            }           // $this->call('UserTableSeeder');
	}

}
