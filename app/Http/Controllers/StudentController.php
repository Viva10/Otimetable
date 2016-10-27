<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;use App\Department_has_level;use App\Level;use App\Faculty;use App\Department;
/**
 * Description of StudentController
 *
 * @author Bodas Djoumessi
 */
class StudentController extends controller{
    public function index(){
        $students = Department_has_level::orderBy('departments_id','asc')->paginate(15);
        $i = 0;
        
        return view('students.students',compact('students','i'));
    }
    
    public function addStudents(){
        $faculties = Faculty::get();
        $levels = Level::get();
        
        return view('students.addStudents',compact('faculties','levels'));
    }
    
    public function saveStudent(Request $request){
        $student = new Department_has_level;
        $student->departments_id = $request->department;
        $student->levels_id  = $request->level;
        $student_exist = Department_has_level::where('departments_id',$request->department)->where('levels_id',$request->level)->first();
        if($student_exist == null){
            if($student->save()){
                return redirect()->back()->with('message','Success! Created '.Department::getDepartmentName($student->departments_id).' Level'
                        . ' '.Level::getLevelName($student->levels_id).' from '.Faculty::getFacultyName($request->faculty));
            }
            else
                redirect()->back()->with('error','Error! Failed to create student group with department:'.Department::getDepartmentName($request->department).''
                        . ' level '.Level::getLevelName($student->levels_id));
        }
        else
            return redirect()->back()->with('error','!!!!!! Student already exist in the database !!!!!!');
    }

    public function deleteStudents(Request $request){
        $page = $request->get('page',1);
        $students = Department_has_level::orderBy('departments_id','asc')->paginate(15);
        $i = 0;
        
        return view('students.deleteStudents',compact('students','i','page'));
    }
    
    public function deleteStudentPage($id,$page){
        $page = $page;
        $student = Department_has_level::find($id);
        $dept = Department::getDepartmentName($student->departments_id);
        $faculty = Department::getDeptFaculty($student->departments_id);
        $level = Level::getLevelName($student->levels_id);
        $courses = Department_has_level::getStudentCourses($student->levels_id);
        $stud = $id;
        return view('students.deleteStudentPage',compact('dept','faculty','level','courses','stud','page'));        
    }
    
    public function deleteStudent($id,$page){
        $student = Department_has_level::find($id);
        if($student != null){
            if($student->delete()){
                return redirect()->to('deleteStudents/?page='.$page)->with('message','Success! Deleted Student group '.Department::getDepartmentName($student->departments_id)
                        .' '.Level::getLevelName($student->levels_id).' of '.Faculty::getFacultyName(Department::getDeptFaculty($student->departments_id)));
            }
            else
                return redirect()->to('deleteStudents/?page='.$page)->with('error','Error! Failed to delete student group'.Department::getDepartmentName($student->departments_id)
                        .Level::getLevelName($student->levels_id));
        }
        else
            return redirect()->to('deleteStudents')->with('error','Error! Value does not exist in the database.');
    }
    
    public function levels(){
        $levels = Level::orderBy('level_name','asc')->paginate(10);
        $i = 0;
        
        return view('students.levels',compact('levels','i'));
    }
    
    public function saveLevel(Request $request){
        $level = new Level;
        $level->level_name = $request->level_name;
        $check = Level::where('level_name',$request->level_name)->first();
        if($check == null){
            if($level->save()){
                return redirect()->back()->with('message','Success! New Levels:'.$level->level_name.' created');
            }
            else
                return redirect()->back()->with('error','Error! Levels '.$request->level_name.' not created');
        }
        else
            return redirect()->back()->with('error','Sorry! Levels name already exist. See below!');
    }
    
    public function deleteLevel($id){
        $level = Level::find($id);
        if($level != null){
            $level_departments = Department_has_level::where('levels_id',$id)->get();
            $level_courses = DB::table('level_has_courses')->where('levels_id',$id)->get();
            
            if($level_departments != null)
                foreach($level_departments as $level_department)
                    $level_department->delete();
          
            if($level_courses != null){
                foreach($level_courses as $level_course)
                    $level_course->delete();
            }
            
            if($level->delete()){
                return redirect()->back()->with('message','Success! Levels '.$level->level_name.' deleted from database.');
            }
            else
                return redirect()->back()->with('error','Error! Failed to delete Level');
        }
        else
            return redirect()->back()->with('error','Error! Level id does not exist in database.');
    }
    
    public function studentDetail($id){
        $student = Department_has_level::find($id);
        $dept = Department::getDepartmentCode($student->departments_id);
        $faculty = Department::getDeptFaculty($student->departments_id);
        $level = Level::getLevelName($student->levels_id);
        $courses = Department_has_level::getStudentCourses($student->levels_id);
        $stud = $id;
        return view('students.studentDetail',compact('dept','faculty','level','courses','stud'));      
    }
}
