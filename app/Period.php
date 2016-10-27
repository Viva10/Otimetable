<?php namespace App;
use DB;
use Illuminate\Database\Eloquent\Model as Eloquent;
/**
 * Description of Period
 *
 * @author Bodas Djoumessi
 */
class Period extends Eloquent{
    public static function getFullPeriodNames($id){
        $query = DB::table('day_has_period')->where('id',$id)->get();
        $result = Array();
        
        foreach($query as $row){
            $result[0] = Period::getDayName($row->days_id);
            $result[1] = Period::getPeriodName($row->periods_id);
        }
        return $result;
    }
    //////////////////////////////////////////////
    public static function getDayName($id){
        $query = DB::table('days')->where('id',$id)->pluck('day_name');
        
        return $query;
    }
    //////////////////////////////////////////////
    public static function getPeriodName($id){
        $query = DB::table('periods')->where('id',$id)->first();
        $result = $query->period_start.'-'.$query->period_end;
        
        return $result;
    }
    ////////////////////////////////////////////////
    public static function generatePeriods(){
        $days = Day::get();
        $times = Period::get();
        if($days != null){
            if($times != null){
                foreach($days as $day){
                    foreach($times as $time){
                        $check = Day_has_period::where('days_id',$day->id)->where('periods_id',$time->id)->first();
                        if($check == null){
                            $result = Day_has_period::insert(['days_id' => $day->id,'periods_id' => $time->id]);
                        }
                    }
                }

                $periods = Day_has_period::orderBy('periods_id','asc')->paginate(15);
            }
            else
                $periods = '';
        }
        else
            $periods = '';
        
        return $periods;
    }
    ////////////////////////////////////////
    public static function getDayId($id){
        $query = Day_has_period::where('id',$id)->pluck('days_id');
        
        return $query;
    }
     ////////////////////////////////////////
    public static function getTimeId($id){
        $query = Day_has_period::where('id',$id)->pluck('periods_id');
        
        return $query;
    }
    
}
