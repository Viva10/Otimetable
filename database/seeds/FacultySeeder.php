<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FacultySeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            $faker = Faker\Factory::create();

            $limit = 8;

            for ($i = 0; $i < $limit; $i++) {
                DB::table('faculties')->insert([ //,
                    'faculty_name' => $faker->company,
                ]);
		// $this->call('UserTableSeeder');
            }
	}

}
