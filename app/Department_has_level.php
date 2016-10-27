<?php namespace App;


use DB;
use Illuminate\Database\Eloquent\Model as Eloquent;
/**
 * Description of Department_has_level
 *
 * @author Bodas Djoumessi
 */
class Department_has_level extends Eloquent{
    public static function getStudentCourses($id){
        $query = DB::table('course_is_taken_by')->where('department_has_levels_id',$id)->get();
        $courses = [];
        foreach($query as $row){
            $courses[] = $row->courses_id;
        }
        return $courses;
    }
    
    public static function getStudentsName($id){
        //$students = [];
        $query = Department_has_level::find($id);
        $student = ''.Department::getDepartmentName($query->departments_id).' '.Level::getLevelName($query->levels_id);
        
        return $student;
    }
     ///////////////////////////////////////////////////////////
    public static function getStudentsId(){
        $query = Department_has_level::get();
        $students = [];
        foreach($query as $row){
            $students[] = $row->id;
        }
        
        return $students;
    }
}
