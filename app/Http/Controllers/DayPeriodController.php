<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;use App\Day_has_period;use App\Period;use App\Day;
/**
 * Description of DayPeriodController
 *
 * @author Bodas Djoumessi
 */
class DayPeriodController extends controller{
    public function index(){
        
        if(count(Day_has_period::get()) == 0)
            $periods = Period::generatePeriods();
        else
            $periods = Day_has_period::orderBy('periods_id','asc')->paginate(15);
        $i = 0;
        
        return view('periods.periods',compact('periods','i'));
    }
    
    public function days(){
        $days = Day::get();
        $i = 0;
        
        return view('periods.days',compact('days','i'));
    }
    
    public function saveDay(Request $request){
        $day = new Day;
        $day->day_name = $request->day_name;
        $check = Day::where('day_name',$request->day_name)->first();
        if(!$check){
            if($day->save()){
                return redirect()->back()->with('message','Success! Day successfully added.');
            }
            else
                return redirect()->back()->with('error','Error! Failed to save day');
        }
        else
            return redirect()->back()->with('error','Error! Day name already exist in database.');
    }
    
    public function deleteDay($id){
        $day = Day::find($id);
        if($day != null){
            if($day->delete()){
                return redirect()->back()->with('message','Success! Successfully deleted day.');
            }
            else
                return redirect()->back()->with('error','Error! Failed to delete day.');
        }
        else
            return redirect()->back()->with('error','Error! Day \'id\' no longer exist in database.');
    }
    
    public function manageTimes(){
        $times = Period::orderBy('period_start','asc')->paginate(15);
        $i = 0;
        
        return view('periods.times',compact('times','i'));
    }
    
    public function saveTime(Request $request){
        $time = new Period;
        $check = Period::where('period_start',$request->time_start)->first();
        $time->period_start = $request->time_start;
        $time->period_end = $request->time_end;
        if($check == null){
            if($time->save()){
                return redirect()->back()->with('message','Success! Successfully created time.');
            }
            else
                return redirect()->back()->with('errror','Error! Failed to create time.');
        }
        else
            return redirect()->back()->with('error','Error! Time name already exist in the database.');
    }
    
    public function deleteTime($id){
        $time = Period::find($id);
        if($time != null){
            if($time->delete()){
                return redirect()->back()->with('message','Success! Successfully deleted time '.$time->period_name);
            }
            else
                return redirect()->back()->with('error','Error! Failed to delete time '.$time->period_name);
        }
        else
            return redirect()->back()->with('error','Error! Time\'s \'id\' no longer exist in database');
    }
    
    public function deletePeriods(){
        $periods = Day_has_period::orderBy('periods_id','asc')->paginate(15);
        $i = 0;
        
        return view('periods.deletePeriods',compact('periods','i'));
    }
    
    public function deletePeriod($id){
        $period = Day_has_period::find($id);
        if($period != null){
            if($period->delete()){
                return redirect()->back()->with('message','Success! Successfully deleted period');
            }
            else
                return redirect()->back()->with('error','Error! Failed to delete period.');
        }
        else
            return redirect()->back()->with('error','Error! Period\'s \'id\' no longer exist in the database');
    }
    /*
     * Note Times in the controller is the equivalent of Period in the database
     * Note Period in the controller is the equivalent of Day_has_period in the database
     */
    public function managePeriods(){
        if(Day_has_period::get() == null)
            $periods = Period::generatePeriods();
        else
            $periods = Day_has_period::orderBy('periods_id','asc')->paginate(15);
        $days = Day::get();
        $times = Period::get();
        $i = 0;
        
        return view('periods.managePeriods',compact('periods','i','days','times'));
    }
    
    public function savePeriod(Request $request){
        $check = Day_has_period::where('days_id',$request->day)->where('periods_id',$request->time)->first();
        if($check == null){
            $period = new Day_has_period();
            $period->days_id = $request->day;
            $period->periods_id = $request->time;
            if($period->save()){
                return redirect()->back()->with('message','Success! Period '.Period::getDayName($period->days_id).' '
                        .Period::getPeriodName($period->periods_id).' created successfully');
            }
            else
                return redirect()->back()->with('error','Error! Failed to create period');
        }
        else
            return redirect()->back()->with('error','Error! Period already exist in the database.');
    }
    
    public function includePeriod($id){
        $period = Day_has_period::find($id);
        if($period != null){
            $period->availability = 1;
            if($period->save()){
                return redirect()->back()->with('message','Success! Period successfully re-included to the scheduler');
            }
            else
                return redirect()->back()->with('error','Error! Failed to include period to the scheduler');
        }
        else
            return redirect()->back()->with('error','Error! Period\'s \'id\' no longer exist in the database.');
    }
    
    public function excludePeriod($id){
        $period = Day_has_period::find($id);
        if($period != null){
            $period->availability = 0;
            if($period->save()){
                return redirect()->back()->with('message','Success! Period successfully Excluded from the scheduler');
            }
            else
                return redirect()->back()->with('error','Error! Failed to exclude period from the scheduler');
        }
        else
            return redirect()->back()->with('error','Error! Period\'s \'id\' no longer exist in the database.');
    }
}
