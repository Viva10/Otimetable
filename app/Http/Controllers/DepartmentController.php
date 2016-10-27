<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;use App\Faculty;use DB;use App\Department;

/**
 * Description of DepartmentController
 *
 * @author Bodas Djoumessi
 */
class DepartmentController extends controller{
    public function facultyIndex(){
        $faculties = Faculty::orderBy('faculty_name','asc')->paginate(15);
        $i = 0;
        return view('faculties.faculties',compact('faculties','i'));
    }
    
    public function addFaculty(){
        $faculties = Faculty::orderBy('faculty_name','asc')->paginate(15);
        $i = 0;
        
        return view('faculties.addFaculty',compact('faculties','i'));
    }
    
    public function saveFaculty(Request $request){
        $faculty = new Faculty;
        $faculty->faculty_name = $request->faculty_name;
       
        $check = Faculty::where('faculty_name',$request->faculty_name)->first();
        if($check == null){
            if($faculty->save()){
               return redirect()->back()->with('message','Success! Faculty of '.$faculty->faculty_name.' created successfully.');
            }
            else
                return redirecet()->back()->with('error','Error! Failed to create faculty of '.$request->faculty_name);
        }
        else
            return redirect()->back()->with('error','Error! Faculty name already exist in the database. Check below!!!');
    }
    
    public function deleteFaculties(){
        $faculties = Faculty::orderBy('faculty_name','asc')->paginate(15);
        $i = 0;
        
        return view('faculties.deleteFaculties',compact('faculties','i'));
    }
    
    public function deleteFacultyPage($id){
        $courses = $studentsS = $students = [];
        $faculty = Faculty::find($id);
        if($faculty != null){
            $departments = Faculty::getFacultyDepartments($id);
            $lecturers = Faculty::getFacultyLecturers($id);
            foreach($departments as $department){
                $studentsS[] = \App\Department_has_level::where('departments_id',$department)->get();
                $courses[] = DB::table('department_has_courses')->where('departments_id',$department)->pluck('courses_id');
            }
            $size = count($studentsS);
            for($i = 0; $i < $size; $i++){
                foreach($studentsS[$i] as $row)
                    $students[] = $row;
            }//dd($students);
                        
            return view('faculties.deleteFacultyPage',compact('departments','lecturers','courses','students','faculty'));
        }
        else
            return redirect()->back()->with('error','Error! Faculty does not exist in the database!');
    }
    
    public function deleteFaculty($id){
        $faculty = Faculty::find($id);
        if($faculty != null){
           if($faculty->delete()){
               return redirect()->to('deleteFaculties')->with('message','Success! Faculty Successfully deleted.');
           }
           else
               return redirect()->to('deleteFaculties')->with('error','Error! Failed to delete Faculty');
        }
        else
            return redirect()->back()->with('error','Error! Faculty does not exist in the database!');

    }
    
    public function addDepartment(){
        $faculties = Faculty::get();
        $departments = Department::orderBy('department_name','asc')->paginate(15);
        $i = 0;
        
        return view('faculties.addDepartment',compact('faculties','departments','i'));
    }
    
    public function saveDepartment(Request $request){
        $faculty_id = $request->faculty;
        $department = new Department;
        $department->department_name = $request->department_name;
        $department->department_code = $request->code;
        $check = Department::where('department_name',$request->department_name)->orWhere('department_code',$request->code)->first();
        if($check != null){
            return redirect()->back()->with('error','Error! Department name or code already exist in the database below.');
        }
        if($department->save()){
            $dept_fac = DB::table('faculty_has_departments')->insert(['faculties_id' => $faculty_id,'departments_id' => $department->id]);
            if($dept_fac){
                return redirect()->back()->with('message','Success! Department Successfully created and attached to faculty.');
            }
            else
                return redirect()->back()->with('error','Success! Department Successfully created but failed to attach it to faculty.');
        }
        return redirect()->back()->with('error','Error! Failed to create department.');
    }
    
    public function deleteDepartments(){
        $departments = Department::orderBy('department_name','asc')->paginate(15);
        $i = 0;
        
        return view('faculties.deleteDepartments',compact('departments','i'));
    }
    
    public function deleteDepartmentPage($id){
        $dept = Department::find($id);
        if($dept != null){
            $department_name = $dept->department_name;
            $faculty = Department::getDeptFaculty($dept->id);
            $courses = Department::getDepartmentCourses($dept->id);
            $students = \App\Department_has_level::where('departments_id',$id)->get();
        }    //dd($students);
        return view('faculties.deleteDepartmentPage',compact('courses','department_name','id','students','faculty'));
    }
    public function deleteDepartment($id){
        $dept = Department::find($id);
        if($dept != null){
            $levels = \App\Department_has_level::where('departments_id',$id)->delete();
            $faculties = DB::table('faculty_has_departments')->where('departments_id',$id)->delete();
            if($dept->delete()){
                return redirect()->back()->with('message','Sucess! Department '.$dept->department_name.' successfully deleted');
            }
            else
                return redirect()->back()->with('error','Error! Failed to delete department from the database.');
        }
        else
            return redirect()->back()->with('error','Error! Department \'id\' does not exist in the database.');
    }
    
    public function editFaculty($id){
        $faculty = Faculty::find($id);
        
        return view('faculties.editFaculty',compact('faculty'));        
    }
    
    public function updateFaculty($id,Request $request){
        $faculty = Faculty::find($id);
        if($faculty != null){
            $faculty_name = $faculty->faculty_name;
            $faculty->faculty_name = $request->faculty_name;        
            if($faculty->save()){
                return redirect()->to('faculties')->with('message','Success! Faculty name changed from '.$faculty_name.' to '.$faculty->faculty_name);
            }
            else
                return redirect()->back()->with('error','Error! Failed to update faculty name.');
        }
        else
            return redirect()->back ()->with('error','Error! Faculty \'id\' does not exist in the database.');
    }
    
    public function editDepartment($id){
        $department = Department::find($id);
        
        return view('faculties.editDepartment',compact('department'));
    }
    
    public function updateDepartment($id,Request $request){
        $department = Department::find($id);
        if($department != null){
            $dept_name = $department->department_name;
            $dept_code = $department->department_code;
            $department->department_name = $request->department_name;
            $department->department_code = $request->department_code;
            if($department->save()){
                return redirect()->back()->with('message','Success! Department name updated from '.$dept_name.' to '.$department->department_name.' '
                        . ' and code from '.$dept_code.' to '.$department->department_code);                
            }
            else
                return redirect()->back()->with('error','Error! Failed to update department');
        }
        else
            return redirect()->back()->with('error','Error! Department \'id\' not found in database.');
    }
    
    public function departmentFaculty(){
        $departments = Department::orderBy('department_code','asc')->paginate(15);
        $i = 0;
        return view('faculties.departmentFaculty',compact('departments','i'));
    }
    
    public function changeDeptFaculty($id){
        $department = Department::find($id);
        $faculties = Faculty::get();
        
        return view('faculties.changeDeptFac',compact('department','faculties'));        
    }
    
    public function updateDeptFac($id,Request $request){
        $dept = DB::table('faculty_has_departments')->where('departments_id',$id)->first();
        
        if($dept != null){
            if(DB::table('faculty_has_departments')->where('departments_id',$id)->update(['faculties_id' => $request->faculty])){
                return redirect()->to('departmentFaculty')->with('message','Success! Department\'s faculty changed to '.Faculty::getFacultyName($request->faculty));
            }
            else
                return redirect()->back()->with('error','Error! Failed to change department\'s faculty');
        }
        else{
            $result = DB::table('faculty_has_departments')->insert(['departments_id' => $id,'faculties_id' => $request->faculty]);
            if($result){
                return redirect()->to('departmentFaculty')->with('message','Success! Department\'s faculty changed to '.Faculty::getFacultyName($request->faculty));
            }
            else
                return redirect()->back()->with('error','Error! Failed to change department\'s faculty');
        }    
    }
}
