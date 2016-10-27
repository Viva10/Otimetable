<?php namespace App\Http\Controllers;
use App\Course;use App\Lecturer;use App\Period;use App\Hall;use App\Department;use App\Level;use App\Schedule;
use App\Timetable_version;use App\Course_has_lecturer;
use App\Http\Requests;use DB;
use App\Http\Controllers\Controller;
//require_once '/path/to/Faker/src/autoload.php';
use Illuminate\Http\Request;

/**
 * Description of ScheduleController
 *
 * @author Bodas Djoumessi
 */
class ScheduleController extends controller{
    
    public function simulate(Request $request){
        ini_set('max_execution_time', -1);
        ini_set('memory_limit',-1);
        $timetable_name = $request->timetable_name;
        $maxPeriods = 3;
        $max_fp = 150;$hall_exist = 0;
        $halls = [];
        $check = 0;$control = $control2 = 0;
        $levels = $number_levels = $courses = 0;
        $levels = Level::getAllLevels();
        $coursesArray = [];
        $coursesArray2 = [];
        $number_levels = Level::getLevelCounts();//get the number of levels
        $schedules[] = [];
        $assign_next = (object)[];
        $num_periods = DB::table('day_has_periods')->count();//get the number of periods
       
        $turns = 4;
//        $periods = Period::get();
//        foreach($periods as $period){
//            $Periods[] = $period->id; 
//        }//dd($Periods);
        //dd($schedules);        
        //$schedules[1] = (object)[(object)["hall_id" => 3,"course_id" => 7],(object)["hall_id" => 1,"course_id" => 14]];
        for($i = 0; $i < $num_periods; $i++){
           $halls[] = Hall::getAllHalls(); //Read all halls from the database. 
        }//dd($halls);
        foreach($levels as $level){
            $coursesArray[] = Level::getAllLevelCourses($level);
        }
//        
//        foreach($levels as $level){
//            $coursesArray2[] = Level::getAllLevelCoursesWithTwoPeriods($level);
//        }
//        foreach($levels as $level){
//            $coursesArray3[] = Level::getAllLevelCoursesWithThreePeriods($level);
//        }
        
        do{//dd($coursesArray);
//           if($turns == 2){
//                $coursesArray = $coursesArray2;
//            }
//             if($turns == 1){
//                $coursesArray = $coursesArray3;
//            }
            foreach($coursesArray as $courses){
            //// for loop for levels
                //$courses = Level::getAllLevelCourses($level);
                //dd($courses);
                
                $Schedules = $schedules;
                if(!empty($courses)){//ensure that courses exist for that level
                    for($i = 0; $i < $num_periods; $i++){/*Loop for all periods from database to probably allocate course in one of the periods*/
                        //dd($courses);
                        foreach($courses as $course){ //dd($course);
                            $control++;$control2++;
                            if(Course::isCourseHavingLecturer($course->id)){//to check that course has a lecturer
                                //if(Course::isNotExistingOnThatDay($course->id,$i,$schedules)){
                                    if($course->flag == 0){// check to ensure that course has not already been assigned
                                        if(empty($schedules[$i])){//dd($schedules);
                                            $assign = Schedule::assignHall($halls[$i],$course,$i,$Schedules);
                                            if($assign != 'failed'){
                                                $schedules[$i][] = (object)["hall_id" => $assign->hall_id,"course_id" => $assign->course_id,
                                                    "fp" => $assign->fp,"periods_id" => $assign->periods_id];
                                                $halls[$i][$assign->index]->flag = 1;
                                                $course->flag = 1;
                                                /*write code to go back to foreach above*/
                                            }
                                            
                                        }           

                                        else{//dd($schedules[$i]);
                                            foreach($halls[$i] as $hall){
                                                if($hall->flag == 0){//check only halls which are unassigned **************************
                                                    $fp = (Course::getCourseStudentSize($course->id)/Hall::getHallCapacity($hall->hall_id))*100;
                                                    if($fp <= $max_fp){
                                                        $hall_exist = 1;
                                                        break;
                                                    }
                                                }
                                            }

                                            if($hall_exist == 1){
                                                foreach ($schedules[$i] as $pre_course){
                                                    if(($check=!Schedule::validateNonLecturerClash($course,$pre_course))==1){//check for lecturer and student clash
                                                        //$check = 1;
                                                        //echo "prof".$check.$control."<br/>";
                                                        break;
                                                    }
                                                    if(($check=!Schedule::validateNonStudentClash($course,$pre_course))==1){
                                                        //$check = 1;
                                                        //echo "stud".$check.$control."<br/>";
                                                        break;
                                                    }
                                                }//end foreach pre_course
                                                //if($control == 289)
                                                //    dd($check);
                                                if($check == 0){//echo $control.$i.'<br/>';
                                                    //echo $control."<br/>";
                                                           
                                                    $assign_next = Schedule::assignHallNext($halls[$i],$course,$schedules[$i],$i,$Schedules);
                                                    
    //                                                if($control == 289)
    //                                                dd($assign_next);
                                                    //print_r($assign_next);
                                                     //echo $i;
                                                    if($assign_next != 'failed'){
                                                        if(!empty(($assign_next))){
                                                            if($assign_next->hall_id == -1){
                                                                $schedules[$i][$assign_next->schedule_change]->course_id = $assign_next->course_id;
                                                                $schedules[$i][$assign_next->schedule_change]->fp = $assign_next->fp;
                                                                $course->flag = 1;
                                                                //dd($schedules[$i][$assign_next->schedule_change]);
                                                                foreach($courses as $course){
                                                                    if($course->id == $assign_next->course_change_id){
                                                                        $course->flag = 0;
                                                                        break;
                                                                    }                                                    
                                                                }
                                                                //if($control > 20)   
                                                                    //dd($courses);
                                                            }
                                                            else{
                                                                $schedules[$i][] = (object)["hall_id" => $assign_next->hall_id,"course_id" => $assign_next->course_id,
                                                                    "fp" => $assign_next->fp,"periods_id" => $assign_next->periods_id];
                                                                //echo "yes";
                                                                $halls[$i][$assign_next->index]->flag = 1;

                                                                $course->flag = 1;//dd($halls[$i][$assign_next->index]->flag);
                                                                //if($control > 20)   
                                                                    //dd($schedules);
                                                            }
                                                        }
                                                    }
                                                    //$check =1;
                                            }//end of if hall exist
                                            $hall_exist = 0;
                                        }                        
                                    }//end check if course is unassigned
                                }   
                            }
                            //$check = 0;
                        }//end of foreach course
                    }//end of loop for period 
                }
                //dd($schedules); 
            }//end of foreach level
//            $good = false;
//            foreach($coursesArray as $courses){
//                foreach($courses as $course){
//                    foreach($schedules as $schedule){
//                        foreach($schedule as $row){
//                            if($course->id == $row->course_id){
//                                $good = true;
//                                break;
//                            }
//                        }
//                        if($good == true){
//                            break;
//                        }
//                    }
//                    if($good == false){
//                        $course->flag = 0;
//                    }
//                    $good = false;
//                }
//            }
//            if($turns == 2){
//                $good = false;
//                $match_count = 0;//dd($schedules);
//                foreach($coursesArray as $courses){
//                    foreach($courses as $course){
//                        foreach($schedules as $schedule){
//                            foreach($schedule as $row){
//                                if($course->id == $row->course_id){
//                                    $match_count++;
//                                    if($match_count == 2){
//                                        $good = true;
//                                        break;
//                                    }
//                                }
//                            }
//                            if($good == true){
//                                break;
//                            }
//                        }
//                        if($good == false){
//                            $course->flag = 0;
//                            $match_count = 0;
//                        }
//                        if($good == true){
//                            $good = false;
//                            $match_count = 0;
//                        }
//                        //$good = false;
//                    }
//                }
//                //dd($schedules);
//            }
            
            $turns--;
        }while($turns >= 0);//dd($control);
        
        //dd($halls);
//        dd($schedules); 
        //dd($coursesArray);
        $timetable_version = new \App\Timetable_version;
        $timetable_version->version_name = $timetable_name;
        $timetable_version->save();
        
        $scheduleId = $timetable_version->id;
        /***Generate a snapshot of the current database at time of scheduling for generating reports in the future***/
        $status = (object)[];
        $status->total_courses = Course::get();//dd($status->total_courses);
        $status->lecturers_for_courses = Course_has_lecturer::get();
        
        $timetable = new Schedule;
        $timetable->timetable_versions_id = $timetable_version->id;
        $timetable->schedule = serialize($schedules);//dd(unserialize(($timetable->schedule)));
        $timetable->schedule_report = serialize($status);
        $timetable->save();
        
        $faculties = \App\Faculty::get();
        $halls = \App\Hall::count();
        $lecturers = \App\Lecturer::count();
        $students = \App\Department_has_level::count();
        $periods = \App\Day_has_period::count();
        $courses = \App\Course::count();
        $schedulesS = \App\Timetable_version::count();
        return view('schedule.simulate',compact('students','halls','lecturers','periods','courses','schedules','schedulesS','faculties','timetable_name','scheduleId'));
    }
    
    public function timetable(){
        $halls = \App\Hall::count();
            $lecturers = \App\Lecturer::count();
            $students = \App\Department_has_level::count();
            $periods = \App\Day_has_period::count();
            $courses = \App\Course::count();
            $schedulesS = \App\Timetable_version::count();
            
        return view('schedule.timetable',compact('students','halls','lecturers','periods','courses','schedulesS'));
    }
    ////////////////////////////////////////////////////////////////////
    public function facultySchedule($id,Request $request){
        $scheduleId = $id;
        $timetable_name = \App\Timetable_version::where('id',$id)->pluck('version_name');
        $not_exist = TRUE;
        $coded_schedules = Schedule::where('timetable_versions_id',$id)->pluck('schedule');
        $schedules = unserialize($coded_schedules);//dd($schedules);
        $faculty_id = $request->faculty;

        foreach($schedules as $schedule){
            foreach($schedule as $row){//dd($row->course_id);
                if(Course::getCourseFacultyId($row->course_id) != $faculty_id){
                    $row->course_id = '';
                    $row->hall_id = '';
                    $row->fp = '';
                    $row->periods_id = '';
                }
            }
        }
        //dd($schedules);
        $faculties = \App\Faculty::get();

        return view('schedule.thisSchedule',compact('schedules','faculties','timetable_name','scheduleId'));
    }
    /////////////////////////////////////////////////////////////////////////////
    public function thisSchedule($id){
        $scheduleId = $id;
        $timetable_name = \App\Timetable_version::where('id',$id)->pluck('version_name');
        $coded_schedules = Schedule::where('timetable_versions_id',$id)->pluck('schedule');
        $schedules = unserialize($coded_schedules);//dd($schedules);
        $faculties = \App\Faculty::get();
        
        return view('schedule.thisSchedule',compact('schedules','faculties','timetable_name','scheduleId'));
    }
    /////////////////////////////////////////////////////////////
    public function allSchedule(){
        $allSchedules = \App\Timetable_version::orderBy('created_at','dsc')->paginate(15);
        $i = 0;

        return view('schedule.allSchedule',compact('allSchedules','i'));
    }
    //////////////////////////////////////////////////////////////
    public function deleteSchedule(){
        $allSchedules = \App\Timetable_version::orderBy('version_name','asc')->paginate(15);
        $i = 0;
        
        return view('schedule.deleteSchedule',compact('allSchedules','i'));
    }
    /////////////////////////////////////////////////////////////////////
    public function deleteScheduleFinal($id){
        $schedule = \App\Timetable_version::find($id);
        if($schedule){
            if($schedule->delete()){
                return redirect()->back()->with('message','Success! Schedule deleted successfully');
            }
            else
                return redirect ()->back()->with('error','Error! Failed to delete Schedule');
        }
    }
    ////////////////////////////////////////////////////////////////////////////
    public function lecturerSchedulePage(){
        $faculties = \App\Faculty::get();
        $lecturers = Lecturer::orderBy('lecturer_name','asc')->paginate(15);
        $schedulesLists = \App\Timetable_version::orderBy('created_at','dsc')->get();
        foreach($schedulesLists as $row){
            $schedulesList[] = $row;
        }
        $i = 0;
        
        return view('schedule.lecSchedule',compact('faculties','lecturers','schedulesList','i'));
    }
    
    public function viewLecSchedule(Request $request){
        $scheduleId = $request->schedule;//dd($request->schedule);
        $timetable_name = \App\Timetable_version::where('id',$request->schedule)->pluck('version_name');
        $not_exist = TRUE;
        $coded_schedules = Schedule::where('timetable_versions_id',$request->schedule)->pluck('schedule');//dd($coded_schedules);
        $schedules = unserialize($coded_schedules);
        $faculty_id = $request->faculty;
        $lecturer_id = $request->lecturer;

        foreach($schedules as $schedule){
            foreach($schedule as $row){//dd($row->course_id);
                foreach(Course::getCourseLecturers($row->course_id) as $lec){
                    if($lec == $lecturer_id){
                        $not_exist = false;
                        break;
                    }
                }
                if($not_exist == true){
                    $row->course_id = '';
                    $row->hall_id = '';
                    $row->fp = '';
                    $row->periods_id = '';
                }
                else
                    $not_exist = true;
            }
        }
        $faculties = \App\Faculty::get();
        $lecturers = Lecturer::orderBy('lecturer_name','asc')->paginate(15);
        $schedulesList = Schedule::get();////remember to remove this line.. useless
        $i = 0;
        
        return view('schedule.viewLecSchedule',compact('faculties','lecturers','schedules','scheduleId','schedulesList','i','timetable_name','lecturer_id'));        
    }
    //////////////////////////////////////////////////////////////////////////////
    public function viewLecturerSchedule($id,Request $request){
        $scheduleId = $request->schedule;//dd($request->schedule);
        $timetable_name = \App\Timetable_version::where('id',$request->schedule)->pluck('version_name');
        $not_exist = TRUE;
        $coded_schedules = Schedule::where('timetable_versions_id',$request->schedule)->pluck('schedule');//dd($coded_schedules);
        $schedules = unserialize($coded_schedules);
        $lecturer_id = $id;

        foreach($schedules as $schedule){
            foreach($schedule as $row){//dd($row->course_id);
                foreach(Course::getCourseLecturers($row->course_id) as $lec){
                    if($lec == $lecturer_id){
                        $not_exist = false;
                        break;
                    }
                }
                if($not_exist == true){
                    $row->course_id = '';
                    $row->hall_id = '';
                    $row->fp = '';
                    $row->periods_id = '';
                }
                else
                    $not_exist = true;
            }
        }
        $faculties = \App\Faculty::get();
        $lecturers = Lecturer::orderBy('lecturer_name','asc')->paginate(15);
        $schedulesList = Schedule::get();
        $i = 0;
        
        return view('schedule.viewLecSchedule',compact('faculties','lecturers','schedules','scheduleId','schedulesList','i','timetable_name','lecturer_id'));                
    }
    ///////////////////////////////////////////////////////////////////////////////////
    public function studentSchedulePage(){
        $faculties = \App\Faculty::get();
        $students = \App\Department_has_level::orderBy('departments_id','asc')->paginate(15);
        $schedulesLists = \App\Timetable_version::orderBy('created_at','dsc')->get();
        foreach($schedulesLists as $row){
            $schedulesList[] = $row;
        }
        $i = 0;
        
        return view('schedule.studSchedulePage',compact('faculties','students','schedulesList','i'));
    }
    /////////////////////////////////////////////////////////////////////////////////////
    public function getFacStudents(Request $request){
        $id = $request->id;
        $departments = \App\Faculty_has_department::where('faculties_id',$id)->get();
        foreach($departments as $dept){
            $students[] = DB::table('department_has_levels')->where('departments_id',$dept->departments_id)->get();
        }
        $var = '<option selected="" value="">Select Student</option>';
        foreach($students as $student){
            foreach($student as $row){
               $var .= '<option name="'.$row->id.'" value="'.$row->id.'" >'.  Department::getDepartmentName($row->departments_id).' '.Level::getLevelName($row->levels_id).'</option> ';
            }
        }
        return $var;
    }
    //////////////////////////////////////////////////////////////////////////////////////
    public function viewStudSchedule(Request $request){
        $scheduleId = $request->schedule;//dd($request->schedule);
        $timetable_name = \App\Timetable_version::where('id',$request->schedule)->pluck('version_name');
        $not_exist = TRUE;
        $coded_schedules = Schedule::where('timetable_versions_id',$request->schedule)->pluck('schedule');//dd($coded_schedules);
        $schedules = unserialize($coded_schedules);
        $faculty_id = $request->faculty;
        $student_id = $request->student;

        foreach($schedules as $schedule){
            foreach($schedule as $row){//dd($row->course_id);
                foreach(Course::getCourseStudents($row->course_id) as $stud){
                    if($stud == $student_id){
                        $not_exist = false;
                        break;
                    }
                }
                if($not_exist == true){
                    $row->course_id = '';
                    $row->hall_id = '';
                    $row->fp = '';
                    $row->periods_id = '';
                }
                else
                    $not_exist = true;
            }
        }
        $faculties = \App\Faculty::get();
        $students = \App\Department_has_level::orderBy('departments_id','asc')->paginate(15);
        $schedulesList = Schedule::get();
        $i = 0;
        
        return view('schedule.viewStudSchedule',compact('faculties','students','schedules','scheduleId','schedulesList','i','timetable_name','student_id'));        

    }
    //////////////for student from the tables//////////////////////////////
    public function viewStudTableSchedule($id,Request $request){
        $scheduleId = $request->schedule;//dd($request->schedule);
        $timetable_name = \App\Timetable_version::where('id',$request->schedule)->pluck('version_name');
        $not_exist = TRUE;
        $coded_schedules = Schedule::where('timetable_versions_id',$request->schedule)->pluck('schedule');//dd($coded_schedules);
        $schedules = unserialize($coded_schedules);
        $faculty_id = $request->faculty;
        $student_id = $id;

        foreach($schedules as $schedule){
            foreach($schedule as $row){//dd($row->course_id);
                foreach(Course::getCourseStudents($row->course_id) as $stud){
                    if($stud == $student_id){
                        $not_exist = false;
                        break;
                    }
                }
                if($not_exist == true){
                    $row->course_id = '';
                    $row->hall_id = '';
                    $row->fp = '';
                    $row->periods_id = '';
                }
                else
                    $not_exist = true;
            }
        }
        $faculties = \App\Faculty::get();
        $students = \App\Department_has_level::orderBy('departments_id','asc')->paginate(15);
        $schedulesList = Schedule::get();
        $i = 0;
        
        return view('schedule.viewStudSchedule',compact('faculties','students','schedules','scheduleId','schedulesList','i','timetable_name','student_id'));        
    }
    //////////////////////////////////////////////////////course Shcedule
    public function courseSchedulePage(){
        $faculties = \App\Faculty::get();
        $courses = \App\Course::orderBy('course_code','asc')->paginate(15);
        $schedulesLists = \App\Timetable_version::orderBy('created_at','dsc')->get();
        foreach($schedulesLists as $row){
            $schedulesList[] = $row;
        }
        $i = 0;
        
        return view('schedule.courseSchedulePage',compact('faculties','courses','schedulesList','i'));
    }
    /////////////////////////////////////////////////////////////////////////////
    public function getDeptCourses(Request $request){
        $id = $request->id;
        $courses = \App\Department_has_course::where('departments_id',$id)->get();

        $var = '<option selected="" value="">Select Course</option>';
        foreach($courses as $row){
            $var .= '<option name="'.$row->courses_id.'" value="'.$row->courses_id.'" >'.  Course::getCourseName($row->courses_id).'</option> ';
        }
        return $var;
    }    
    ////////////////////////////////////////////////////////////////////////////////
    public function viewCourseSchedule(Request $request){
        $scheduleId = $request->schedule;//dd($request->schedule);
        $timetable_name = \App\Timetable_version::where('id',$request->schedule)->pluck('version_name');
        $not_exist = TRUE;
        $coded_schedules = Schedule::where('timetable_versions_id',$request->schedule)->pluck('schedule');//dd($coded_schedules);
        $schedules = unserialize($coded_schedules);
        $course_id = $request->course;
        
        foreach($schedules as $schedule){
            foreach($schedule as $row){//dd($row);
                if($row->course_id == $course_id){
                    $not_exist = false;
                    //break;
                }
                else{
                    $row->course_id = '';
                    $row->hall_id = '';
                    $row->fp = '';
                    $row->periods_id = '';
                }
            }
            $not_exist = true;
        }
        $faculties = \App\Faculty::get();
        $courses = \App\Course::orderBy('course_code','asc')->paginate(15);
        $schedulesList = Schedule::get();
        $i = 0;
        
        return view('schedule.viewCourseSchedule',compact('faculties','courses','schedules','scheduleId','schedulesList','i','timetable_name','course_id'));        
    }
    ////////////////////////////////////////////////////////////////////////////////
    public function viewCourseTableSchedule($id,Request $request){
        $scheduleId = $request->schedule;//dd($request->schedule);
        $timetable_name = \App\Timetable_version::where('id',$request->schedule)->pluck('version_name');
        $not_exist = TRUE;
        $coded_schedules = Schedule::where('timetable_versions_id',$request->schedule)->pluck('schedule');//dd($coded_schedules);
        $schedules = unserialize($coded_schedules);
        $course_id = $id;

        foreach($schedules as $schedule){
            foreach($schedule as $row){//dd($row->course_id);
                if($row->course_id == $course_id){
                    $not_exist = false;
                    //break;
                }
                else{
                    $row->course_id = '';
                    $row->hall_id = '';
                    $row->fp = '';
                    $row->periods_id = '';
                }
            }
            
            $not_exist = true;
            
        }
        $faculties = \App\Faculty::get();
        $courses = Course::orderBy('course_code','asc')->paginate(15);
        $schedulesList = Schedule::get();
        $i = 0;
        
        return view('schedule.viewCourseSchedule',compact('faculties','courses','schedules','scheduleId','schedulesList','i','timetable_name','course_id'));                
    }
    
    public function scheduleReport($scheduleId){
        $timetable_version = \App\Timetable_version::find($scheduleId);
        $schedule_name = $timetable_version->version_name;
        $coded_data = Schedule::where('timetable_versions_id',$timetable_version->id)->first();
        $schedules = unserialize($coded_data->schedule);
        $report = unserialize($coded_data->schedule_report);
        $total_courses = $report->total_courses;
        $lecturers_for_courses = $report->lecturers_for_courses;
        $courses_count = count($total_courses);//total number of courses 
        $lec_courses_count = count($lecturers_for_courses);
        $visible_course_count = $eligible_course_count = $num_double_period = $num_single_period = 0;
        $courses_scheduled = 0;
        
        foreach($total_courses as $course){//counting number of courses visible to the scheduler.
            if($course->availability == 1){
                $visible_course_count++;
                $visible_courses[] = $course;
            }
            
        }

        foreach($visible_courses as $course){//generating courses that where eligible for scheduling.
            foreach($lecturers_for_courses as $lecCourse){
                if($course->id == $lecCourse->courses_id){
                    $eligible_course_count++;
                    $eligible_courses[] = $course;
                
                    if($course->period_number == 2){
                        $double_period_courses[] = $course;
                        $num_double_period++;
                    }
                    elseif($course->period_number == 1){
                        $single_period_courses[] = $course;
                        $num_single_period++;
                    }
                }
            }
        }
        
        foreach($schedules as $schedule){//general schedule count
            $courses_scheduled += count($schedule);
        }
        
        foreach($double_period_courses as $row){
            $doubles[] = (object)["course_id" => $row->id,"count" => 0];
        }
        foreach($single_period_courses as $row){
            $singles[] = (object)["course_id" => $row->id,"count" => 0];
        }
        //***generate data for double course schedules**//
        $double = Schedule::generateScheduleCount($doubles,$schedules);   
        $double_half = $double_full = [];
        foreach($double as $row){//separating fully scheduled courses from half scheduled courses
            if($row->count == 2){
                $double_full[] = $row;
            }
            elseif($row->count == 1){
                $double_half[] = $row;
            }
        }
        
        //***generate data for single course schedules***//
        $single = Schedule::generateScheduleCount($singles,$schedules);
        ////////////////////////////////////////////////////////////////////////////
        
        $fullReport = (object)[];
        $fullReport->double_half = $double_half;
        $fullReport->total_courses = $courses_count;
        $fullReport->double_count = $num_double_period;
        $fullReport->single_count = $num_single_period;
        $fullReport->double_full_courses_scheduled_count = count($double_full);
        $fullReport->double_half_courses_scheduled_count = count($double_half);
        $fullReport->single_courses_scheduled_count = count($single);
        if(count($single_period_courses) > 0 && count($double_period_courses) > 0){
            $fullReport->double_success = count($double_full)/count($double_period_courses)*100;
            $fullReport->single_success = count($single)/count($single_period_courses)*100;
            $fullReport->overall_success = ($fullReport->double_success + $fullReport->single_success)/2;
        }
        
        $fullReport->double_not_scheduled = Schedule::unScheduledCourses($double_period_courses,$double);
        $fullReport->single_not_scheduled = Schedule::unScheduledCourses($single_period_courses,$single);
        $i = 0;
        return view('schedule.scheduleReport',compact('fullReport','schedule_name','i'));
    }
}
