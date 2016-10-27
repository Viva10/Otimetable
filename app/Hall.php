<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Description of Hall
 *
 * @author Bodas Djoumessi
 */
class Hall extends Eloquent{
    //////////////////////////////////
    public static function saveHall($hall_name,$hall_capacity){
        $query = DB::table('Halls')->insert(['hall_name' => $hall_name,'hall_capacity' => $hall_capacity]);
        
        return $query;
    }
    ////////////////////////////////////
    public static function updateHall($id,$hall_name,$hall_capacity){
        $query = DB::table('Halls')->where('id',$id)->update(['hall_name' => $hall_name,'hall_capacity' => $hall_capacity]);
        
        return $query;
    }
    /////////////////////////////////////
    public static function getHallName($id){
        $query = DB::table('Halls')->where('id',$id)->pluck('hall_name');
        
        return $query;
    }
    /////////////////////////////////////////
    public static function getHallCapacity($id){
        $query = DB::table('Halls')->where('id',$id)->pluck('hall_capacity');
        
        return $query;
    }
    ///////////////////////////////////////////
    public static function getAvailabilityFlag($id,$period){
        $query = DB::table('hall_during_period')->where('halls_id',$id)
                                                ->where('periods_id',$period)
                                                ->pluck('status');
        return $query;
    }
    ///////////////////////////////////////////
    public static function getFittingPercentage($student_size,$hall_capacity){
        $fitting_percentage = ($student_size/$hall_capacity) * 100;
        
        return $fitting_percentage;
    }
    //////////////////////////////////////////
    public static function getAllHalls(){
        $query = DB::table('halls')->where('hall_availability',1)->get();
        $halls = Array();
        foreach($query as $row){
            $halls[] = (object)["hall_id" => $row->id,"flag" => 0];
        }
        return $halls;
    }
}
