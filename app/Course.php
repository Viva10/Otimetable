<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model as Eloquent;


/**
 * Description of Course
 *
 * @author Bodas Djoumessi
 */
class Course extends Eloquent{
    ////////////////////////////////////////////////////
    public static function insertCourse($course_name,$course_code,$student_size,$period_number,$practical,$course_status){
        $query = DB::table('courses')->insert(['course_name' => $course_name,'course_code' => $course_code,'student_size'
            => $student_size,'period_number' => $period_number,'practical' => $practical,'course_status' => $course_status]);
    
        return $query;
    }
    ///////////////////////////////////////////////
    public static function saveCourse($course_name,$course_code,$student_size,$period_number,$practical,$course_status){
         $insert = Array("course_name"=>$course_name,"course_code"=>$course_code,"student_size" => $student_size,
             "period_number" => $period_number,"practical" => $practical,"course_status" => $course_status);
        $query = DB::table('courses')->insert($insert);
        return $query;
    }
    //////////////////////////////////////////////
    public static function getCourse($id){
        $query = DB::table('courses')->where('id',$id)->first();
        
        return $query;
    }
    /////////////////////////////////////////////////
    public static function getCourseName($id){
        $course_name = DB::table('courses')->where('id',$id)->pluck('course_name');

         return $course_name;
    }
    ///////////////////////////////////////////////////
    public static function getCourseCode($id){
        $course_code = DB::table('courses')->where('id',$id)->pluck('course_code');
        
        return $course_code;
    }
    //////////////////////////////////////////////////
    public static function getCourseStudentSize($id){
        $student_size = DB::table('courses')->where('id',$id)->pluck('student_size');
        
        return $student_size;
    }
    //////////////////////////////////////////////////
    public static function getCourseStatus($id){
        $course_status = DB::table('courses')->where('id',$id)->pluck('course_status');
        
        return $course_status;
    }
    ///////////////////////////////////////////////////
    public static function getCoursePeriodNumber($id){
        $period_number = DB::table('courses')->where('id',$id)->pluck('period_number');
        
        return $period_number;
    }
    //////////////////////////////////////////////////////
    /*This method below queries all the department_has_levels_id i.e all students taking the course and sends it as an array*/
    public static function getStudentsTakingCourse($id){
        $query = DB::table('course_is_taken_by')->where('courses_id',$id)->get();
           $course_taken_by = [];
           foreach($query as $row){
               $course_taken_by[] = $row->department_has_levels_id;
           }
        return $course_taken_by;
    }
    /////////////////////////////////////////////////////
    public static function getCourseDept($id){
        $query = DB::table('department_has_courses')->where('courses_id',$id)->pluck('departments_id');
        
        return $query;
    }
    /////////////////////////////////////////////////////////
    public static function getCourseFaculty($id){
        $query = DB::table('department_has_courses')->where('courses_id',$id)->pluck('departments_id');
        $departments_id = $query;
        $result = '';
        $result = Department::getDeptFaculty($departments_id);
    
        return $result;
    }
    
    ////////////////////////////////////////////////////////////
    public static function updateCourse($course_id,$course_name,$course_code,$student_size,$period_number,$practical,$course_status){
        $query = DB::table('courses')->where('id',$course_id)->update(['course_name' => $course_name,
            'course_code' => $course_code,'student_size' => $student_size,'period_number' => $period_number,
            'practical' => $practical,'course_status' => $course_status]);
    
        return $query;
    }
    ///////////////////////////////////////////////////////////
    public static function getCourseLecturerNames($courses_id){
        $query = DB::table('course_has_lecturers')->where('courses_id',$courses_id)->get();
        $lecturers = Array();
        
        $lecturers = Lecturer::getLecturerNames($query);
        
        return $lecturers;
    }
    ///////////////////////////////////////////////////////////
    public static function getCourseLecturers($courses_id){
        $query = DB::table('course_has_lecturers')->where('courses_id',$courses_id)->get();
        $lecturers = Array();
        $i = 0;
        foreach($query as $row){
            $lecturers[$i] = $row->lecturers_id;
            $i++;
        }
        return $lecturers;
    }
    /////////////////////////////////////////////////////////////
    /*
     * August 20 2016
     * By Bodas Djoumessi
     */
    ///////////////////////////////////////////////////////////
    public static function getCourseStudents($id){
         $query = DB::table('course_is_taken_by')->where('courses_id',$id)->get();
        $students = Array();
        
        foreach($query as $row){
            $students[] = $row->department_has_levels_id;
        }
        return $students;
    }
    ////////////////////////////////////////////////////////////
    public static function deleteCourse($id){
        $query = DB::table('courses')->where('id',$id)->delete();
        
        return $query;
    }
    ///////////////////////////////////////////////////////////
    public static function isCourseHavingLecturer($id){
        $query = DB::table('course_has_lecturers')->where('courses_id',$id)->get();
        
        if(empty($query))
            return 0;
        else 
            return 1;
    } 
    ///////////////////////////////////////////////////////////
    public static function hasTwoPeriods($id){
        $query = DB::table('courses')->where('id',$id)->pluck('period_number');
        if($query > 1)
            return 1;
        if($query == 1)
            return 0;
    }
     ///////////////////////////////////////////////////////////
    public static function hasThreePeriods($id){
        $query = DB::table('courses')->where('id',$id)->pluck('period_number');
        if($query > 2)
            return 1;
        if($query == 1)
            return 0;
    }
        ///////////////////////////////////////////////////////////
    public static function getCourseStudentsName($id){
         $query = DB::table('course_is_taken_by')->where('courses_id',$id)->get();
        $students = Array();
        $full_student = [];
        foreach($query as $row){
            $students[] = $row->department_has_levels_id;
        }
        foreach($students as $stud){
            $student = Department_has_level::find($stud);
            $full_student[] = Department::getDepartmentCode($student->departments_id).' '.Level::getLevelName($student->levels_id);
            
        }
        return $full_student;
    }
    ////////////////////////////////////////////////////////////
    public static function getCourseLevel($id){
        $courseLevel = Level_has_course::where('courses_id',$id)->first();
       
        if($courseLevel != null){
            $level = Level::getLevelName($courseLevel->levels_id);
        }
        else
            $level = '-';
        
        return $level;
    }
    ///////////////////////////////////////////////////////////
    public static function getCoursesId(){
        $query = Course::get();
        $courses = [];
        foreach($query as $row){
            $courses[] = $row->id;
        }
        
        return $courses;
    }
    /////////////////////////////////////////////////////////
    public static function getCourseFacultyId($id){
        $query = DB::table('department_has_courses')->where('courses_id',$id)->pluck('departments_id');
        $departments_id = $query;
        $result = '';
        $result = Department::getDeptFacultyId($departments_id);
    
        return $result;
    }
    ////////////////////////////////////////////////////////////
//    public static function isNotExistingOnThatDay($course,$i,$schedules){
//        $day = App\Period::g
//        foreach($schedules as $schedule){
//            if()
//        }
//    }
}