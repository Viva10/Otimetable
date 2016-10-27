<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;use App\Level_has_course;
use App\Course;use App\Hall;use App\Lecturer;use App\Faculty;use App\Department;use App\Period;use App\Level;
use Illuminate\Http\Request;use App\Schedule;use DB;use App\Department_has_course;use App\Course_has_lecturer;use App\Department_has_level;
/**
 * Description of CourseController
 *
 * @author Bodas Djoumessi
 */
class CourseController extends controller {
    public function index(){
        $courses = Course::orderBy('course_code','asc')->paginate(15);
        
        $i = 0;
        
        return view('courses.courses',compact('courses','i'));
    }
    
    public function editCourse($id){
        $course = Course::find($id);
        $levels = Level::orderBy('level_name','asc')->get();
        $faculties = Faculty::orderBy('faculty_name','asc')->get();
        
        return view('courses.editCourse',compact('course','levels','faculties'));
    }
   
    public function editCourseFinal($id,Request $request){
        $query = Course::find($id);
        $query->course_name = $request->course_name;
        $query->course_code = $request->course_code;
        $query->student_size = $request->student_size;
        $query->period_number = $request->period_number;
        $query->type = $request->type;
        if(Level_has_course::where('courses_id',$id)->first())
            $courseLevel = Level_has_course::where('courses_id',$id)->update(['levels_id' => $request->level]);
        else
            $courseLevel = Level_has_course::insert(['levels_id' => $request->level,'courses_id' => $id]);
        if(Department_has_course::where('courses_id',$id)->first())
            $courseDepartment = Department_has_course::where('courses_id',$id)->update(['departments_id' => $request->department]);
        else
            $courseDepartment = Department_has_course::insert(['departments_id' => $request->department,'courses_id' => $id]);
        
        if($query->save() && $courseLevel && $courseDepartment){
            return redirect()->to('courses')->with('message','Success! Course successfully updated.');
        }
        else{
            return redirect()->to('courses')->with('error','Error! Failed to update course.');
        }
    }

    public function addCourses(){
        $faculties = Faculty::get();
        $levels = Level::get();
        $students = \App\Department_has_level::orderBy('departments_id','asc')->get();
        
        return view('courses.addCourses',compact('faculties','levels','students'));
    }
    
    public function saveCourse(Request $request){
        $query = new Course;
        $query->course_name = $request->course_name;
        $query->course_code = $request->course_code;
        $query->student_size = $request->student_size;
        $query->period_number = $request->number_of_period;
        $query->type = $request->type;
        if($query->save()){
            $courseDepartment = new Department_has_course();
            $courseDepartment->courses_id = $query->id;
            $courseDepartment->departments_id = $request->department;
            
            $courseLevel = new \App\Level_has_course;
           // $courseStudent = new \App\Course_is_taken_by;
            
            $courseLevel->levels_id = $request->level;
            $courseLevel->courses_id = $query->id;
            
            $courseStudent = DB::table('course_is_taken_by')->insert(['courses_id' => $query->id,'department_has_levels_id' => $request->students]);
//            $courseStudent->courses_id = $query->id;
//            $courseStudent->department_has_levels_id = $request->student;
            
            if($courseLevel->save()){
                
                if($courseStudent){             
            
                    if($courseDepartment->save()){
                        return redirect()->back()->with('message','Succesfully created course '.$query->course_code.' under the department of '
                                .' '.Department::getDepartmentName($request->department).' with all links created!');
                    }else
                        return redirect()->back()->with('message','Succesfully created course '.$query->course_code.' but FAILED establish department link!!!');
                }
                else
                    return redirect()->back()->with('message','Succesfully created course '.$query->course_code.' but FAILED establish department and students link!!!');
            }
            else{
                return redirect()->back()->with('message','Succesfully created course '.$query->course_code.' but FAILED establish department,students and level link!!!');
            }
        }
        else {
            return redirect()->back()->with('error','Error! Failed to create course!');
        }
    }
    
    public function deleteCourses(){
        $courses = Course::orderBy('course_code','asc')->paginate(15);
        $i = 0;
        return view('courses.deleteCourses',compact('courses','i'));
    }
    
    public function deleteCoursePage($id){
        $course = Course::where('id',$id)->first();
        $lecturers = Course::getCourseLecturers($id);
        //remember to also pass the students taking the course
        return view('courses.deleteCoursePage',compact('course','lecturers'));
    }
    
    public function deleteCourse($id){
        $query = Course::find($id);
        if($query != null){
            $deleteStudents = DB::table('course_is_taken_by')->where('courses_id',$id)->delete();
            $deleteLecturers = DB::table('course_has_lecturers')->where('courses_id',$id)->delete();
            $deleteDepartment = DB::table('department_has_courses')->where('courses_id',$id)->delete();
            $deleteLevel = DB::table('level_has_courses')->where('courses_id',$id)->delete();
            if($query->delete()){
                return redirect()->to('deleteCourses')->with('message','Success! Course deleted from the database.');
            }
            else{
                return redirect()->to('deleteCourses')->with('error','Error! Course failed to delete.');
            }
        }
        else
            return redirect()->to('deleteCourses')->with('error','Error! Course \'id\' does not exist in the database.');
    }

    public function getDepts(Request $request){
        
        $id = $request->id;
        $departments = DB::table('faculty_has_departments')->where('faculties_id',$id)->get();
        
        $var = '<option selected="" value="">Select Department</option>';
        foreach($departments as $dept){
            $var .= '<option value="'.$dept->departments_id.'" >'.Department::getDepartmentName($dept->departments_id).'</option> ';
        }
        
        return $var;
    }
    
    public function courseLecturers(){
        $courses = Course::orderBy('course_code','asc')->paginate(15);
        $message = '';
        $i = 0;
        
        return view('courses.courseLecturers',compact('courses','i'));
    }
    
    public function courseDetail($id){
        $students = [];
        $lecturers = [];
        $course = Course::where('id',$id)->first();
        $lecturers = Course::getCourseLecturers($id);
        $studentsS = Course::getCourseStudents($id);
        if($studentsS != null){
            foreach($studentsS as $row){
                $students[] = \App\Department_has_level::find($row);
            }
        }
        return view('courses.courseDetail',  compact('course','lecturers','students'));
    }
    
    public function unAssignLecturer($id){
        $lecturers = Course::getCourseLecturers($id);
        $course = $id;
        $i = 0;
        $message = '';
        $results = 2;
        
        return view('courses.unAssignLecturer',compact('lecturers','i','course','message','results'));
    }
    
    public function unAssignLecturerFinal($course_id,$lecturer_id){
        $query = Course_has_lecturer::where('courses_id',$course_id)->where('lecturers_id',$lecturer_id)->first();
        if($query->delete()){
            return redirect()->to('unAssignCourseLecturer/'.$course_id)->with('message',Lecturer::getLecturerName($lecturer_id).' '
                    . 'Successfully un-assigned from the course '.Course::getCourseName($course_id));
        }
        else{
            return redirect()->to('unAssignCourseLecturer/'.$course_id)->with('error','Failed to unassign lecturer from course.');
        }
    }
    
    public function assignLecturerPage($id){
        $faculties = Faculty::get();
        $course = $id;
        
        return view('courses.assignLecturer',compact('faculties','course'));
    }
    
    Public function saveAssign($id,Request $request){
        $query = new Course_has_lecturer;
        $query->lecturers_id = $request->lecturer;
        $query->courses_id = $id;
        if($query->save()){
            return redirect()->to('courseNoLecturer')->with('message','Succes! Course successfully assigned to '.Lecturer::getLecturerName($request->lecturer));
        }
        else{
            return redirect()->to('courseNoLecturer')->with('error','Error! Failed to assign lecturer to course');
        }
    }
    
    public function courseWithoutLecturer(){
        $courses = DB::table('courses')->leftJoin('course_has_lecturers', 'courses.id', '=', 'course_has_lecturers.courses_id')
                   ->select('courses.*')
                   ->whereNull('course_has_lecturers.courses_id')
                   ->paginate(15);
        $i = 0;
        return view('courses.coursesNoLecturer',compact('courses','i'));
        
    }
    
    public function courseWithLecturer(){
        $courses = DB::table('courses')->whereExists(function($query)
                                        {
                                        $query->select(DB::raw(1))
                                            ->from('course_has_lecturers')
                                            ->whereRaw('course_has_lecturers.courses_id = courses.id');
                                            })->paginate(15);
        $i = 0;
        return view('courses.courseWithLecturer',compact('courses','i'));
    }

    public function getLecturers(Request $request){
        
        $id = $request->id;
        $lecturers = DB::table('faculty_has_lecturers')->where('faculties_id',$id)->get();
        
        $var = '<option selected="" value="">Select Lecturer</option>';
        foreach($lecturers as $lecturer){
            $var .= '<option name="'.$lecturer->lecturers_id.'" value="'.$lecturer->lecturers_id.'" >'.Lecturer::getLecturerName($lecturer->lecturers_id).'</option> ';
        }
        
        return $var;
    }
    
    public function courseVisibility(){
        $courses = Course::orderBy('course_code','asc')->paginate(15);

        $i = 0;
        
        return view('courses.courseVisibility',compact('courses','i'));
    }
    
    public function includeCourse($id){
        $query = Course::find($id);
        $query->availability = 1;
        if($query->save()){
            return redirect()->back()->with('message','Success! '.$query->course_code.' included to scheduler');
        }
        else{
            return redirect()->back()->with('error','Error! Failed to include '.Course::getCourseName($id).' to scheduler');
        }
    }
    
    public function excludeCourse($id){
        $query = Course::find($id);
        $query->availability = 0;
        if($query->save()){
            return redirect()->back()->with('message','Success! '.$query->course_code.' exclude from scheduler');
        }
        else{
            return redirect()->back()->with('error','Error! Failed to exclude '.Course::getCourseName($id).' from the scheduler');
        }
        
    }
    
    public function courseStudent(){
        $courses = Course::orderBy('course_code','asc')->paginate(15);
        $i = 0;
        
        return view('courses.courseStudents',compact('courses','i'));
    }
    
    public function coursesWithoutStudents(){
         $courses = DB::table('courses')->leftJoin('course_is_taken_by', 'courses.id', '=', 'course_is_taken_by.courses_id')
                   ->select('courses.*')
                   ->whereNull('course_is_taken_by.courses_id')
                   ->paginate(10);
        $i = 0;
        return view('courses.coursesNoStudent',compact('courses','i'));
        
    }
    
    public function coursesWithStudents(){
         $courses = DB::table('courses')->whereExists(function($query)
                                        {
                                        $query->select(DB::raw(1))
                                            ->from('course_is_taken_by')
                                            ->whereRaw('course_is_taken_by.courses_id = courses.id');
                                            })->paginate(15);
        $i = 0;
        return view('courses.coursesWithStudent',compact('courses','i'));
    }
    
    public function assignCourseStudent($id){
        $faculties = Faculty::get();
        $course = $id;
        
        return view('courses.assignStudent',compact('faculties','course'));
    }
    
    public function saveAssignStudent($id,Request $request){
        $query = DB::table('course_is_taken_by')->insert(['department_has_levels_id' => $request->student,'courses_id' => $id]);
        if($query){
            return redirect()->to('courseNoStudent')->with('message','Succes! Course successfully assigned to '.Department_has_level::getStudentsName($request->student));
        }
        else{
            return redirect()->to('courseNoStudent')->with('error','Error! Failed to assign students to course');
        }
    }

    public function getStudents(Request $request){
        $id = $request->id;
        $students = DB::table('department_has_levels')->where('departments_id',$id)->get();
        $var = '<option selected="" value="">Select Student</option>';
        foreach($students as $student){
            $var .= '<option name="'.$student->id.'" value="'.$student->id.'" >'.  Department::getDepartmentName($student->departments_id).' '.Level::getLevelName($student->levels_id).'</option> ';
        }
        return $var;
    }
    
    public function unAssignStudent($id){
        $studentsS = Course::getCourseStudents($id);
        $students = [];
        foreach($studentsS as $row){
            $students[] = \App\Department_has_level::find($row);
        }
        $course = $id;
        $i = 0;

        
        return view('courses.unAssignStudent',compact('students','i','course'));
    }
    
    public function unAssignStudentFinal($course_id,$student_id){
        $query = DB::table('course_is_taken_by')->where('courses_id',$course_id)->where('department_has_levels_id',$student_id)->first();
        if($query != null){
            if(DB::table('course_is_taken_by')->where('courses_id',$course_id)->where('department_has_levels_id',$student_id)->delete()){
                return redirect()->to('unAssignCourseStudent/'.$course_id)->with('message','Successfully un-assigned student group from the '.Course::getCourseName($course_id));
            }
            else{
                return redirect()->to('unAssignCourseLecturer/'.$course_id)->with('error','Failed to unassign student from course.');
            }
        }
        else
            return redirect()->back()->with('error','Error! Record does not exist in the database!');
    }
}
