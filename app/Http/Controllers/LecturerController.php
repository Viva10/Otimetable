<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lecturer;use DB;use App\Faculty;use App\Faculty_has_lecturer;use App\Course_has_lecturer;
use Illuminate\Http\Request;
/**
 * Description of HallController
 *
 * @author Bodas Djoumessi
 */
class LecturerController extends controller{
    public function index(){
        $lecturers = Lecturer::orderBy('lecturer_name','asc')->paginate(10);
        $i = 0;
        
        return view('lecturers.lecturers',compact('lecturers','i'));
    }
    
    public function addLecturers(){
        $faculties = Faculty::get();
        
        return view('lecturers.addLecturers',compact('faculties'));
    }
    
    public function saveLecturer(Request $request){
        if($request->gender = 1)
                $gender = 'male';
        if($request->gender = 0)
                $gender = 'female';
        $query = new Lecturer;
        $query->lecturer_name = $request->lecturer_name;
        $query->gender = $gender;
        $query->status = $request->status;
        $query->email = $request->email;
        $query->contact = $request->contact;
        if($query->save()){
            $lecturer_faculty = new Faculty_has_lecturer;
            $lecturer_faculty->faculties_id = $request->faculty;
            $lecturer_faculty->lecturers_id = $query->id;
            if($lecturer_faculty->save()){
                return redirect()->to('lecturers')->with('message','Success! Lecturer created with faculty as '.Faculty::getFacultyName($request->faculty).'');
            }
            else{
                return redirect()->to('lecturers')->with('error','Error! Lecturer data created but faculty inclusion failed.');
            }
        }
        else{
            return redirect()->back()->with('message','Error! Failed to create Lecturer\'s information.');
        }
    }

        public function editLecturer($id){
        $lecturer = Lecturer::find($id);
        $faculties = Faculty::get();

        return view('lecturers.editLecturers',compact('lecturer','faculties'));
    }
    
    public function updateLecturer($id,Request $request){
        if($request->gender = 1)
                $gender = 'male';
        if($request->gender = 0)
                $gender = 'female';
        $query = Lecturer::find($id);
        $query->lecturer_name = $request->lecturer_name;
        $query->gender = $gender;
        $query->status = $request->status;
        $query->email = $request->email;
        $query->contact = $request->contact;
        if($query->save()){
            $lecturer_faculty = Faculty_has_lecturer::where('lecturers_id',$id)->first();
            if($lecturer_faculty == null){
                $lecturer_faculty = new Faculty_has_lecturer ();
                $lecturer_faculty->lecturers_id = $query->id;
            }
            $lecturer_faculty->faculties_id = $request->faculty;
            if($lecturer_faculty->save()){
                return redirect()->to('lecturers')->with('message','Success! Lecturer updated with faculty as '.Faculty::getFacultyName($request->faculty).'');
            }
            else{
                return redirect()->to('lecturers')->with('error','Error! Lecturer data updated but faculty inclusion failed.');
            }
        }
        else{
            return redirect()->back()->with('message','Error! Failed to edit Lecturer\'s information.');
        }
    }

    public function deleteLecturers(){
        $lecturers = Lecturer::orderBy('lecturer_name','asc')->paginate(10);
        $message = '';
        $results = 2;
        $i = 0;
        
        return view('lecturers.deleteLecturers',compact('lecturers','i','results','message'));
    }
    
    public function deleteLecturerPage($id){
        $lecturer = Lecturer::where('id',$id)->first();
            $lecturer_name = Lecturer::getLecturerName($id);
            $lecturer_faculty = Lecturer::getLecturerFacultyName($id);
            $lecturer_courses = Lecturer::getLecturerCourses($id);
            
        return view('lecturers.deleteLecturerPage',compact('lecturer_name','lecturer_faculty','lecturer_courses','id'));
    }
    
    public function deleteLecturer($id){
        $results1 = Course_has_lecturer::where('lecturers_id',$id)->delete();
//        $results1 = DB::table('course_has_lecturers')->where('lecturers_id',$id)->delete();
        $results2 = Faculty_has_lecturer::where('lecturers_id',$id)->delete();
//        $results2 = DB::table('faculty_has_lecturers')->where('lecturers_id',$id)->delete();
        $query = Lecturer::find($id);
        if($query != null){
            if($query->delete()){
                return redirect()->to('deleteLecturers')->with('message','Success! Lecturer deleted from database.');
            }
            else{
                return redirect()->to('deleteLecturers')->with('error','Error! Failed to delete lecturer from database.');
            }
        }
        else
            return redirect()->back()->with('error','Error! Lecturer field does not exist in the database.');

    }
    
    public function lecturerDetail($id){
        $lecturer_name = Lecturer::where('id',$id)->pluck('lecturer_name');
        $courses = Lecturer::getLecturerCourses($id);
        $faculty = Lecturer::getLecturerFaculty($id);
        
        return view('lecturers.lecturerDetail',compact('lecturer_name','courses','faculty'));
    }
}