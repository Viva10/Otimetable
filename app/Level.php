<?php namespace App;

use DB;use App\Level;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Description of Level
 *
 * @author Bodas Djoumessi
 */
class Level extends Eloquent{
    /////////////////////////////////////
    public static function getAllLevels(){
        $query = DB::table('levels')->get();
        $levels = Array();
        $i = 0;
        foreach($query as $row){
            $levels[$i] = $row->id;
            $i++;
        }
        return $levels;
    }
    //////////////////////////////////////////
    public static function getLevelCounts(){
        $query = DB::table('levels')->count();
        
        return $query;
    }
    //////////////////////////////////////////
    public static function getAllLevelCourses($id){
        $query = DB::table('level_has_courses')->where('levels_id',$id)->get();
        $courses = Array();
        foreach($query as $row){
            $courses[] =(object)["id" => $row->courses_id,"flag" => 0];
        }

        return $courses;        
    }
    //////////////////////////////////////////
        //////////////////////////////////////////
    public static function getAllLevelCoursesWithTwoPeriods($level){
        $query = DB::table('level_has_courses')->where('levels_id',$level)->get();
        $courses = Array();
        foreach($query as $row){
            if(Course::hasTwoPeriods($row->courses_id)){
                $courses[] =(object)["id" => $row->courses_id,"flag" => 0];
            }
        }
        //dd($courses);
        return $courses;   
    }
    ///////////////////////////////////////////
    public static function getAllLevelCoursesWithThreePeriods($level){
        $query = DB::table('level_has_courses')->where('levels_id',$level)->get();
        $courses = Array();
        foreach($query as $row){
            if(Course::hasThreePeriods($row->courses_id)){
                $courses[] =(object)["id" => $row->courses_id,"flag" => 0];
            }
        }
        //dd($courses);
        return $courses;
    }
    ///////////////////////////////////////////
    public static function getLevelName($id){
        $query = Level::find($id);
        
        return $query->level_name;
    }
    //////////////////////////////////////////
    public static function getLevel($id){
        $query = Level::find($id);
        
        return $query;
    }
    ///////////////////////////////////////////////////////////
    public static function getLevelsId(){
        $query = Level::get();
        $levels = [];
        foreach($query as $row){
            $levels[] = $row->id;
        }
        
        return $levels;
    }
}
