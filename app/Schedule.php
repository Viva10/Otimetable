<?php namespace App;

use DB;use App\Course;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Description of Schedule
 *
 * @author Bodas Djoumessi
 */
class Schedule extends Eloquent{
    ////////////////////////////////////
    public static function validateNonLecturerClash($course,$pre_course){
        $clash_value = 0;
        $lecturer_for_course = Course::getCourseLecturers($course->id);
        $lecturer_for_pre_course = Course::getCourseLecturers($pre_course->course_id);

        foreach($lecturer_for_course as $lfc){
            foreach($lecturer_for_pre_course as $lfpc){
                if($lfc == $lfpc){
                    $clash_value = 1;
                }
            }
        }
        if($clash_value == 0){
            return 1;
        }
        else if($clash_value == 1){
            return 0;
        }
    }
    /////////////////////////////////////////
    public static function validateNonStudentClash($course,$pre_course){
        $clash_value = 0;
        $students_taking_course = Course::getStudentsTakingCourse($course->id);
        $students_taking_pre_course = Course::getStudentsTakingCourse($pre_course->course_id);
        
        foreach($students_taking_course as $stc){
            foreach($students_taking_pre_course as $stpc){
                if($stc == $stpc){
                    $clash_value = 1;
                }
            }
        }
        if($clash_value == 0){
            return 1;
        }
        else if($clash_value == 1){
            return 0;
        }
    }
    /////////////////////////////////////////
    public static function assignHall($halls,$course,$i,$Schedules){
        $max_fp = 150;
        $fitting_percentage = 0;
        $hallSize = $maxSize = 0;
        $maxHallSizeId = 0;
        $index = 0;
        //Initially first assign course to first hall
        $current_fp = (Course::getCourseStudentSize($course->id)/Hall::getHallCapacity($halls[0]->hall_id))*100;
        $maxSize = Hall::getHallCapacity($halls[0]->hall_id);//get the size of the first hall and assume it to be max size.
        $maxHallSizeId = $halls[0]->hall_id;//assume first hall to be largest and get it's id 
        /**
         * this to control occurence of courses
         */
        $periods = Day_has_period::get();
        foreach($periods as $period){
            $Periods[] = $period->id; 
        }//dd($Periods);
        /**********************/
        /**********************/
        /**********Compare period times***********/
        $pclash = false;
            foreach($Schedules as $Schedule){
                foreach($Schedule as $row){
                    if($row->course_id == $course->id){
                        if($row->periods_id == $Periods[$i]){
                            $pclash = true;
                        }
                        if(Period::getDayId($row->periods_id) == Period::getDayId($Periods[$i])){
                            $pclash = true;
                        }
                    }
                }
            }
        /*********************************/
        if(!$pclash){
            foreach($halls as $hal => $hall){

                $hallSize = Hall::getHallCapacity($hall->hall_id);
                if($hallSize > $maxSize){
                    $maxSize = $hallSize;
                    $maxHallSizeId = $hall->hall_id;
                    $index = $hal;
                }
            }//by default first assign course to the largest present hall.

            $assign = (object)["hall_id" => $maxHallSizeId,"course_id" => $course->id,"fp" => $current_fp,"index" => $hal,"periods_id" => $Periods[$i]];

            //start comparing other hall fitting percentages with respect to the course starting still from the very first hall.
            foreach($halls as $hal => $hall){
                $fitting_percentage = (Course::getCourseStudentSize($course->id)/Hall::getHallCapacity($hall->hall_id))*100;

                if($fitting_percentage > $assign->fp && $fitting_percentage < $max_fp){
                    $current_fp = $fitting_percentage;
                    $assign = (object)["hall_id" => $hall->hall_id,"course_id" => $course->id,"fp" => $current_fp,"index" => $hal,"periods_id" => $Periods[$i]];
                    $index = $hal;
                }
            }
            return $assign;
        }
        else
            return 'failed';
    }
       ////////////////////////////////////////////
    public static function assignHallNext($halls,$course,$schedules,$i,$Schedules){
        $max_fp = 150;
        $min_diff = 30;$failed = -1;
        $fp = $new_fp = $fitting_percentage = 0;
        $hallSize = $maxSize = 0;
        $maxHallSizeId = $current_fp = 0;
        $assign = (object)[];
        //dd($halls[0]->hall_id);
        //Initially first assign course to first hall
//        $current_fp = (Course::getCourseStudentSize($course->id)/Hall::getHallCapacity($halls[0]->hall_id))*100;
//        $maxSize = Hall::getHallCapacity($halls[0]->hall_id);//get the size of the first hall and assume it to be max size.
//        $maxHallSizeId = $halls[0]->hall_id;//assume first hall to be largest 
//        
        /**
         * this to control occurence of courses
         */
        $periods = Day_has_period::get();
        foreach($periods as $period){
            $Periods[] = $period->id; 
        }//dd($Periods);
        /**********************/
        /**********Compare period times***********/
        $pclash = false;
            foreach($Schedules as $Schedule){
                foreach($Schedule as $row){
                    if($row->course_id == $course->id){
                        if($row->periods_id == $Periods[$i]){
                            $pclash = true;
                        }
                        if(Period::getDayId($row->periods_id) == Period::getDayId($Periods[$i])){
                            $pclash = true;
                        }
                    }
                }
            }
        /*********************************/
        if(!$pclash){
            $count = 0;
            foreach($schedules as $index => $schedule){
                $count++;
                $fp = $schedule->fp;
                //dd($schedule->hall_id);  
                $new_fp = (Course::getCourseStudentSize($course->id)/Hall::getHallCapacity($schedule->hall_id)*100);

                if(($new_fp - $fp) >= $min_diff && $new_fp < $max_fp){
                    $assign = (object)["hall_id" => $failed,"course_id" => $course->id,"fp" => $new_fp,"schedule_change" => $index,
                        "course_change_id" => $schedule->course_id,"periods_id" => $Periods[$i]];
                    return $assign;
                }
            }
                //start comparing other hall fitting percentages with respect to the course starting still from the very first hall.
            foreach($halls as $hal => $hall){//dd($hall);
                if($hall->flag == 0){
                    $fitting_percentage = (Course::getCourseStudentSize($course->id)/Hall::getHallCapacity($hall->hall_id))*100;

                    if($fitting_percentage > 60 && $fitting_percentage < $max_fp){
                        $current_fp = $fitting_percentage;
                        $assign = (object)["hall_id" => $hall->hall_id,"course_id" => $course->id,"fp" => $current_fp,"index" => $hal,"periods_id" => $Periods[$i]];
                        return $assign;
                    }
                }
            }
            //echo "I failed";
        }
        else {
            return 'failed';
        }
    }
    
    public static function getScheduleName($id){
        $query = Timetable_version::where('id',$id)->pluck('version_name');
        
        return $query;
    }
    
    public static function generateScheduleCount($number,$schedules){
        foreach($number as $row){//calculate double period courses which were schedule.
            foreach($schedules as $schedule){
                foreach($schedule as $course){
                    if($row->course_id == $course->course_id){
                        $row->count++;
                    }
                }
            }
        }
        return $number;
    }
    
    public static function unScheduledCourses($all,$some){
        $not_scheduled = TRUE;
        $courses = [];
        foreach($all as $course){
            foreach($some as $row){
                if($course->id == $row->course_id){
                    $not_scheduled = FALSE;
                }
            }
            if($not_scheduled){
                $courses[] = $course;
            }
            $not_scheduled = TRUE;
        }
        
        return $courses;
    }
}
