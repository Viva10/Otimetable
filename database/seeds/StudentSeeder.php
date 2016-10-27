<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StudentSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{   
            $faker = Faker\Factory::create();

            $departments = App\Department::getDepartmentsId();
            $levels = App\Level::getLevelsId();
            $j = $m = 0;
            $count1 = App\Department::count();
            $count2 = App\Level::count();
            
            for ($i = 0; $i < $count1; $i++) {
                //if(!\App\Department_has_level::where( 'departments_id',$departments[$i])->where('levels_id',$levels[$i-$m])->first()){
                    DB::table('department_has_levels')->insert([ //,
                        'departments_id' => $departments[$i],
                        'levels_id' => $levels[$i-$m],                    
                    ]);

                    $j++;
                    if($j == $count2){
                        $m += $count2;
                        $j = 0;
                    }
                //}
            }
	}

}
