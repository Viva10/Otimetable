<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
//	public function __construct()
//	{
//		$this->middleware('auth');
//	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(){
            $halls = \App\Hall::count();
            $lecturers = \App\Lecturer::count();
            $students = \App\Department_has_level::count();
            $periods = \App\Day_has_period::count();
            $courses = \App\Course::count();
            $schedulesS = \App\Timetable_version::count();
            
            return view('home',compact('students','halls','lecturers','periods','courses','schedulesS'));
	}

}
