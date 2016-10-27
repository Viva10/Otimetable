<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CourseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
//		Model::unguard();
            $faker = Faker\Factory::create();

            $limit = 1000;

            for ($i = 0; $i < $limit; $i++) {
                DB::table('courses')->insert([ //,
                    'course_name' => $faker->company,
                    'course_code' => $faker->unique()->hexColor,
                    'student_size' => $faker->numberBetween($min = 30, $max = 200),
                    'period_number' => 2,
                    'type' => 'theory',
                    'course_status' => 'C',
                    
                ]);
            }           // $this->call('UserTableSeeder');
	}

}
