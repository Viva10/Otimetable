<?php namespace App;
use Illuminate\Database\Eloquent\Model as Eloquent;
use DB;
/**
 * Description of Faculty
 *
 * @author Bodas Djoumessi
 */
class Faculty extends Eloquent{
    ////////////////////////////////
    public static function getFacultyName($id){
        $query = DB::table('faculties')->where('id',$id)->first();
        if($query == null){
            return '';
        }
        return $query->faculty_name;
    }
    /////////////////////////////////
    public static function getDeanOfFaculty($id){
        $query = DB::table('faculties')->where('id',$id)->pluck('dean');
        
        return $query;
    }
    /////////////////////////////////
    public static function getFacultyDepartments($id){
        $query = DB::table('faculty_has_departments')->where('faculties_id',$id)->get();
        $result = Array();
        foreach($query as $row){
            $result[] = $row->departments_id;
        }
        return $result;
    }
    
    public static function getFacultyLecturers($id){
        $query = DB::table('faculty_has_lecturers')->where('faculties_id',$id)->get();
        $lecturers = [];
        foreach($query as $row){
            $lecturers[] = $row->lecturers_id;
        }
        return $lecturers;
    }
}
