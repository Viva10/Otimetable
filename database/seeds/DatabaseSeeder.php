<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
  		$this->call('CourseSeeder');
                $this->call('LecturerSeeder');
         	$this->call('DepartmentSeeder');
  		$this->call('HallSeeder');
  		$this->call('StudentSeeder');
  		$this->call('CourseIsTakenBySeeder');
  		$this->call('CourseLecturerSeeder');
  		$this->call('CourseLevelSeeder');


	}

}
