<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model as Eloquent;


/**
 * Description of Department
 *
 * @author Bodas Djoumessi
 */
class Department extends Eloquent{
    ////////////////////////////////////////
    public static function getDeptFaculty($id){
        $query = DB::table('faculty_has_departments')->where('departments_id',$id)->pluck('faculties_id');
        
        $faculty = Faculty::getFacultyName($query);
    
        return $faculty;
    }
    ///////////////////////////////////////
    public static function getDepartmentName($id){
        $query = DB::table('departments')->where('id',$id)->pluck('department_name');
        
        return $query;
    }
    ////////////////////////////////////////
    public static function getDepartmentCode($id){
        $query = DB::table('departments')->where('id',$id)->pluck('department_code');
        
        return $query;
    }
    ///////////////////////////////////////
    public static function getDepartmentHOD($id){
        $query = DB::table('departments')->where('id',$id)->pluck('hod');
        
        return $query;
    }
    ////////////////////////////////////////
    public static function getDepartmentCourses($id){
        $query = DB::table('department_has_courses')->where('departments_id',$id)->get();
        $courses = [];
        foreach($query as $row){
            $courses[] = $row->courses_id;
        }
        
        return $courses;
    }
    public static function getDeptFacultyId($id){
        $query = DB::table('faculty_has_departments')->where('departments_id',$id)->pluck('faculties_id');
        
       // $faculty = Faculty::getFacultyName($query);
    
        return $query;
    }
     ///////////////////////////////////////////////////////////
    public static function getDepartmentsId(){
        $query = Department::get();
        $depts = [];
        foreach($query as $row){
            $depts[] = $row->id;
        }
        
        return $depts;
    }
    
}
