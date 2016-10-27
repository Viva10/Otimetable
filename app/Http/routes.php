<?php
use App\Painting;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');


//get('/', function(){
///*	$painting = new Painting;
//	$painting->title = 'Do No Wrong';
//	$painting->artist = 'D. DoRight';
//	$painting->year = 2015;
//	$painting->save();
//
//
//	$painting = Painting::find(1);
//
//	$painting->title = 'Do No Wrong - Just DoRight';
//	
//	$painting->save();
//
//	return $painting->title;*/
//
//	return view('welcome',array('theLocation' => 'NYC','Weather' => 'Sunny'));	
//	
//});

Route::get('/', 'HomeController@index');
Route::post('simulate','ScheduleController@simulate');
Route::get('addCourses','CourseController@addCourses');
Route::post('saveCourse','CourseController@saveCourse');

Route::get('courses','CourseController@index');
Route::get('editCourses/{id}','CourseController@editCourse');
Route::post('updateCourse/{id}','CourseController@editCourseFinal');

Route::get('courseLecturers','CourseController@courseLecturers');
Route::get('courseDetail/{id}','CourseController@courseDetail');
Route::get('courseVisibility','CourseController@courseVisibility');
Route::get('includeCourse/{id}','CourseController@includeCourse');
Route::get('excludeCourse/{id}','CourseController@excludeCourse');

Route::get('deleteCourses','CourseController@deleteCourses');
Route::get('deleteCoursePage/{id}','CourseController@deleteCoursePage');
Route::get('deleteCourse/{id}','CourseController@deleteCourse');

Route::post('saveAssign/{id}','CourseController@saveAssign');
Route::get('courseNoLecturer','CourseController@courseWithoutLecturer');
Route::get('courseWithLecturer','CourseController@courseWithLecturer');
Route::get('unAssignCourseLecturer/{id}','CourseController@unAssignLecturer');
Route::get('unAssignLecturer/{course_id}/{lecturer_id}','CourseController@unAssignLecturerFinal');

Route::get('assignCourseLecturer/{id}','CourseController@assignLecturerPage');
Route::get('getDepartments','CourseController@getDepts');
Route::get('getLecturers','CourseController@getLecturers');
Route::get('getStudents','CourseController@getStudents');


Route::get('halls','HallController@index');
Route::get('addHalls','HallController@addHalls');
Route::post('saveHall','HallController@saveHall');

Route::get('editHalls','HallController@editHalls');

Route::get('editHalls/{id}','HallController@editHall');
Route::post('updateHall/{id}','HallController@updateHall');


Route::get('removeHalls','HallController@removeHalls');
Route::get('removeHall/{id}','HallController@removeHall');

Route::get('includeHalls','HallController@includeHalls');
Route::get('includeHall/{id}','HallController@includeHall');

Route::get('deleteHalls','HallController@deleteHalls');
Route::get('deleteHall/{id}','HallController@deleteHall');

Route::get('lecturers','LecturerController@index');
Route::get('addLecturers','LecturerController@addLecturers');
Route::post('saveLecturers','LecturerController@saveLecturer');

Route::get('lecturerDetail/{id}','LecturerController@lecturerDetail');
Route::get('editLecturers/{id}','LecturerController@editLecturer');
Route::post('updateLecturer/{id}','LecturerController@updateLecturer');

Route::get('deleteLecturers','LecturerController@deleteLecturers');
Route::get('deleteLecturerPage/{id}','LecturerController@deleteLecturerPage');
Route::get('deleteLecturer/{id}','LecturerController@deleteLecturer');

Route::get('students','StudentController@index');
Route::get('deleteStudents','StudentController@deleteStudents');
Route::get('deleteStudentPage/{id}/{page}','StudentController@deleteStudentPage');
Route::get('addStudents','StudentController@addStudents');
Route::post('saveStudent','StudentController@saveStudent');
Route::get('deleteStudent/{id}/{page}','StudentController@deleteStudent');
Route::get('studentDetail/{id}','StudentController@studentDetail');

Route::get('courseStudents','CourseController@courseStudent');
Route::get('courseNoStudent','CourseController@coursesWithoutStudents');
Route::get('courseWithStudent','CourseController@coursesWithStudents');
Route::get('levels','StudentController@levels');
Route::post('saveLevel','StudentController@saveLevel');
Route::get('deleteLevel/{id}','StudentController@deleteLevel');
Route::get('assignCourseStudent/{id}','CourseController@assignCourseStudent');
Route::get('unAssignCourseStudent/{id}','CourseController@unAssignStudent');
Route::get('unAssignStudent/{course_id}/{student_id}','CourseController@unAssignStudentFinal');
Route::post('saveAssignStudent/{id}','CourseController@saveAssignStudent');

Route::get('faculties','DepartmentController@facultyIndex');
Route::get('addFaculties','DepartmentController@addFaculty');
Route::post('saveFaculty','DepartmentController@saveFaculty');
Route::get('deleteFaculties','DepartmentController@deleteFaculties');
Route::get('deleteFacultyPage/{id}','DepartmentController@deleteFacultyPage');
Route::get('deleteFaculty/{id}','DepartmentController@deleteFaculty');
Route::get('addDepartments','DepartmentController@addDepartment');
Route::post('saveDepartment','DepartmentController@saveDepartment');
Route::get('deleteDepartments','DepartmentController@deleteDepartments');

Route::get('deleteDepartmentPage/{id}','DepartmentController@deleteDepartmentPage');
Route::get('deleteDepartment/{id}','DepartmentController@deleteDepartment');

Route::get('editFaculty/{id}','DepartmentController@editFaculty');
Route::post('updateFaculty/{id}','DepartmentController@updateFaculty');

Route::get('editDepartment/{id}','DepartmentController@editDepartment');
Route::post('updateDepartment/{id}','DepartmentController@updateDepartment');

Route::get('departmentFaculty','DepartmentController@departmentFaculty');
Route::get('changeDeptFaculty/{id}','DepartmentController@changeDeptFaculty');
Route::post('updateDeptFac/{id}','DepartmentController@updateDeptFac');

Route::get('dayPeriods','DayPeriodController@index');
Route::get('manageDays','DayPeriodController@days');
Route::post('saveDay','DayPeriodController@saveDay');
Route::get('deleteDay/{id}','DayPeriodController@deleteDay');
Route::get('manageTimes','DayPeriodController@manageTimes');
Route::post('saveTime','DayPeriodController@saveTime');
Route::get('deleteTime/{id}','DayPeriodController@deleteTime');
Route::get('deletePeriods','DayPeriodController@deletePeriods');
Route::get('deletePeriod/{id}','DayPeriodController@deletePeriod');
Route::get('managePeriods','DayPeriodController@managePeriods');
Route::post('savePeriod','DayPeriodController@savePeriod');
Route::get('excludePeriod/{id}','DayPeriodController@excludePeriod');
Route::get('includePeriod/{id}','DayPeriodController@includePeriod');

Route::get('createSchedule','ScheduleController@timetable');
Route::post('facSchedule/{id}','ScheduleController@facultySchedule');

Route::get('schedules/{id}','ScheduleController@thisSchedule');
Route::get('schedules','ScheduleController@allSchedule');
Route::get('deleteSchedules','ScheduleController@deleteSchedule');
Route::get('deleteSchedule/{id}','ScheduleController@deleteScheduleFinal');
Route::get('lecturerSchedules','ScheduleController@lecturerSchedulePage');
Route::post('viewLecturerSchedule','ScheduleController@viewLecSchedule');
Route::post('viewLecturerSchedule/{id}','ScheduleController@viewlecturerSchedule');
Route::get('studentSchedules','ScheduleController@studentSchedulePage');
Route::get('getFacStudents','ScheduleController@getFacStudents');
Route::post('viewStudentSchedule','ScheduleController@viewStudSchedule');
Route::post('viewStudTableSchedule/{id}','ScheduleController@viewStudTableSchedule');
Route::get('courseSchedulesPage','ScheduleController@courseSchedulePage');
Route::get('getDeptCourses','ScheduleController@getDeptCourses');
Route::post('viewCourseSchedule','ScheduleController@viewCourseSchedule');
Route::post('viewCourseTableSchedule/{id}','ScheduleController@viewCourseTableSchedule');

Route::get('scheduleReport/{id}','ScheduleController@scheduleReport');
//Route::get('pdf','ScheduleController@pdf');
//Route::get('getLevels','StudentController@getLevels');
//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);
//Route::get('signup',function(){
//	return View::make('signup');
//});

