<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Description of Lecturer
 *
 * @author Bodas Djoumessi
 */
class Lecturer extends Eloquent{
    //////////////////////////////////
    public static function getLecturerNames($query){
        $lecturer_names = Array();
        $i = 0;
        foreach($query as $row){
            $lecturer_names[$i] = DB::table('lecturers')->where('id',$row->lecturers_id)->pluck('lecturer_name');
            $i++;
        }
        
        return $lecturer_names;
    }
    ///////////////////////////////////
    public static function getLecturerName($id){
        $query = DB::table('lecturers')->where('id',$id)->pluck('lecturer_name');
        
        return $query;
    }
    /////////////////////////////////////
    public static function getLecturerFaculty($id){
        $query = DB::table('faculty_has_lecturers')->where('lecturers_id',$id)->pluck('faculties_id');
        
        return $query;
    }
    /////////////////////////////////////
    public static function getLecturerFacultyName($id){
        $query = DB::table('faculties')->where('id',$id)->pluck('faculty_name');
        
        return $query;
    }
    /////////////////////////////////////
    public static function getLecturerStatus($id){
        $query = DB::table('lecturers')->where('id',$id)->pluck('status');
        
        return $query;
    }
    //////////////////////////////////////
    public static function getLecturerEmail($id){
        $query = DB::table('lecturers')->where('id',$id)->pluck('email');
        
        return $query;
    }
    //////////////////////////////////////
    public static function getLecturerCourses($id){
        $query = DB::table('course_has_lecturers')->where('lecturers_id',$id)->get();
        $results = [];
        foreach($query as $row){
            $results[] = $row->courses_id;
        }
        return $results;
    }
        ///////////////////////////////////////////////////////////
    public static function getLecturersId(){
        $query = Lecturer::get();
        $lecturers = [];
        foreach($query as $row){
            $lecturers[] = $row->id;
        }
        
        return $lecturers;
    }
    
}
