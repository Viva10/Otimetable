<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Facades\DB;
/**
 * Description of CourseLecturerSeeder
 *
 * @author Bodas Djoumessi
 */
class CourseLevelSeeder extends Seeder{
    //put your code here
        public function run()
        {
            $faker = Faker\Factory::create();

            $courses = App\Course::getCoursesId();
            $levels = App\Level::getLevelsId();
            $j = $m = 0;
            $count1 = App\Course::count();
            $count2 = App\Level::count();
            
            for ($i = 0; $i < $count1; $i++) {
                //if(!App\Level_has_course::where('courses_id',$courses[$i])->where('levels_id',$levels[$i-$m])->first()){
                    DB::table('level_has_courses')->insert([ //,
                        'courses_id' => $courses[$i],
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
