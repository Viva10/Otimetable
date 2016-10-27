<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DepartmentSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            $faker = Faker\Factory::create();

            $limit = 60;

            for ($i = 0; $i < $limit; $i++) {
                DB::table('departments')->insert([ //,
                    'department_name' => $faker->unique()->word,
                    'department_code' => $faker->unique()->streetSuffix,    
                ]);
		// $this->call('UserTableSeeder');
            }
	}
}
