<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Hall;use DB;
use Illuminate\Http\Request;
/**
 * Description of HallController
 *
 * @author Bodas Djoumessi
 */
class HallController extends controller{
    public function index(){
        $halls = Hall::orderBy('hall_name','asc')->paginate(10);
        $include = Hall::where('hall_availability',0)->count();
        $exclude = Hall::where('hall_availability',1)->count();
        $i = 0;
        
        return view('halls.halls',compact('halls','i','include','exclude'));
    }
    
    public function addHalls(){
        
        return view('halls.addHalls');
    }
    
    public function saveHall(Request $request){
        $hall_name = $request->hall_name;
        $hall_capacity = $request->hall_capacity;
        $query = new Hall;
        $query->hall_name = $hall_name;
        $query->hall_capacity = $hall_capacity;
        if($query->save()){
            return redirect()->back()->with('message','Hall Successfully Created');
        }
        else{
            return redirect()->back()->with('message','Error! Hall creation failed.');
        }
    }
    
    public function editHalls(){
        
        return view('halls.editHalls');
    }
    
    public function editHall($id){
        $hall = Hall::find($id);
        
        return view('halls.editHalls',compact('hall'));
    }
    
    public function updateHall($id,Request $request){
        $hall_name = $request->hall_name;
        $hall_capacity = $request->hall_capacity;
        $query = Hall::find($id);
        $query->hall_name = $hall_name;
        $query->hall_capacity = $hall_capacity;
        if($query->save()){
            return redirect()->to('halls')->with('message','Hall name successfully changed to '.$hall_name.' and Capacity changed'
                    . ' to '.$hall_capacity);
        }
        else{
            return redirect()->to('halls')->with('error','Error! Failed to change edit hall');
        }
    }

    public function removeHalls(){
        $halls = Hall::where('hall_availability',1)->orderBy('hall_name','asc')->paginate(10);
        $message = '';
        $results = 2;
        $i = 0;
        
        return view('halls.removeHalls',compact('halls','i','message','results'));
    }
    
    public function removeHall($id){
        $halls = Hall::where('hall_availability',1)->orderBy('hall_name','asc')->paginate(10);
        $query = Hall::find($id);
        $query->hall_availability = 0;
        //$query->save();
        if($query->save()){
            return redirect()->back()->with('message',$query->hall_name.' Successfully removed from the scheduler');
        }
        else{
            return redirect()->back()->with('error','Error! Failed to remove '.$query->hall_name.' from the scheduler');
        }
    }
    
    public function includeHalls(){
        $halls = Hall::where('hall_availability',0)->orderBy('hall_name','asc')->paginate(10);
        $message = '';
        $results = 2;
        $i = 0;
        
        return view('halls.includeHalls',compact('halls','i','message','results'));
    }
    
    public function includeHall($id){
        $halls = Hall::where('hall_availability',0)->orderBy('hall_name','asc')->paginate(10);
        //$results = DB::table('halls')->where('id',$id)->update(['hall_availability' => 1]);
        $query = Hall::find($id);
        $query->hall_availability = 1;
        //$query->save();
        if($query->save()){
            return redirect()->back()->with('message',$query->hall_name.' Successfully Re-included into the scheduler');
        }
        else{
            return redirect()->back()->with('error','Error! Failed to include '.$query->hall_name.' to the scheduler');
        }
    }
    
    public function deleteHalls(){
        $halls = Hall::orderBy('hall_name','asc')->paginate(10);
        $message = '';
        $results = 2;
        $i = 0;
        
        return view('halls.deleteHalls',compact('halls','i'));
    }
    
    public function deleteHall($id){
        $halls = Hall::orderBy('hall_name','asc')->paginate(10);
        $query = Hall::find($id);
        if($query != null){
            if($query->delete()){
                return redirect()->back()->with('message','Hall '.$query->hall_name.' Successfully Deleted');
            }
            else{
                return redirect()->back()->with('error','Hall not deleted');
            }
        }
        else
            return redirect()->back()->with('error','Hall id does not exist in database.');
 
    }
}