<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of CourseLecturerSeeder
 *
 * @author Bodas Djoumessi
 */
class CourseLecturerSeeder extends Seeder{
    //put your code here
        public function run()
	{
//		Model::unguard();
            $faker = Faker\Factory::create();
        	Model::unguard();
            $faker = Faker\Factory::create();

            $courses = App\Course::getCoursesId();
            $lecturers = $lecturers1 = App\Lecturer::getLecturersId();
            $j = $m = 0;
            $count1 = App\Course::count();
            $count2 = App\Lecturer::count();
            
            for ($i = 0; $i < $count1; $i++){
                //if(!App\Course_has_lecturer::where('courses_id',$courses[$i])->where('lecturers_id',$lecturers[$i-$m])->first()){
                    DB::table('course_has_lecturers')->insert([ //,
                        'courses_id' => $courses[$i],
                        'lecturers_id' => $lecturers[$i-$m],                    
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
