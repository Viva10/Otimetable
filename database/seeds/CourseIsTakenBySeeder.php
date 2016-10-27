<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Description of CourseLecturerSeeder
 *
 * @author Bodas Djoumessi
 */
class CourseIsTakenBySeeder extends Seeder{
    //put your code here
        public function run()
	{
            $faker = Faker\Factory::create();

            $courses = App\Course::getCoursesId();
            $students = App\Department_has_level::getStudentsId();
            $j = $m = 0;
            $count1 = App\Course::count();
            $count2 = App\Lecturer::count();
            
            for ($i = 0; $i < $count1; $i++) {
                //if(!DB::table('course_is_taken_by')->where('courses_id',$courses[$i])->where('department_has_levels_id',$students[$i-$m])->first()){
                    DB::table('course_is_taken_by')->insert([ //,
                        'courses_id' => $courses[$i],
                        'department_has_levels_id' => $students[$i-$m],                    
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
