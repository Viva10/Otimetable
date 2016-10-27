<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('css/datepicker3.css') !!}" rel="stylesheet">
<link href="{!! asset('css/styles.css') !!}" rel="stylesheet">

<!--Icons-->
<script src="{!! asset('js/lumino.glyphs.js') !!}"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #6699ff" role="navigation">
		<div class="container-fluid">
                    <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
                                                    <a class="navbar-brand" href="{{url('/')}}"><span style="color:orange"></span> <img src="{!! asset('images/logosampleblue.jpg')!!}" height="50px" width="200px" style="margin-top: -8%;margin-left: -8%"/> </a>

				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="#"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="{{URL::to('/')}}"><svg class="glyph stroked monito"><use xlink:href="#stroked-monitor"></use></svg> Home</a></li>
                        <li><a href="{{URL::to('halls')}}">
                            <span data-toggle="collapse" href="#hall-links"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                            <svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg> Halls
                        </li></a>
                        <ul class="children collapse" id="hall-links">
                            <li>
                                    <a class="" href="{{url('addHalls')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Halls
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('includeHalls')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Include Halls
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('removeHalls')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Remove Halls
                                    </a>
                            </li>
                             <li>
                                    <a class="" href="{{url('deleteHalls')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Delete Halls
                                    </a>
                            </li>
                        </ul>
                        
                        <li><a href="{{URL::to('lecturers')}}">
                            <span data-toggle="collapse" href="#lecturer-links"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                            <svg class="glyph stroked male user"><use xlink:href="#stroked-male-user"/></svg> Lecturers
                        </a></li>
                        <ul class="children collapse" id="lecturer-links">
                            <li>
                                    <a class="" href="{{url('addLecturers')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Lecturers
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('deleteLecturers')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Delete Lecturers
                                    </a>
                            </li>
                          
                        </ul>
                                                
                   
                        <li><a href="{{URL::to('courses')}}">
                                <span data-toggle="collapse" href="#course-links"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                                <svg class="glyph stroked folder"><use xlink:href="#stroked-folder"/></svg> Courses
                        </a></li>
                        <ul class="children collapse" id="course-links">
                            <li>
                                    <a class="" href="{{url('addCourses')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Courses
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('courseLecturers')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Course Lecturers
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('courseVisibility')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Course Visibility
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('deleteCourses')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Delete Courses
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('courseStudents')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Course Students
                                    </a>
                            </li>
                        </ul>

			<li><a href="{{url('students')}}">
                                <span data-toggle="collapse" href="#student-links"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                                <svg class="glyph stroked pen tip"><use xlink:href="#stroked-pen-tip"/></svg> Student Levels
                            </a></li>
                         <ul class="children collapse" id="student-links">
                            <li>
                                    <a class="" href="{{url('addStudents')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Stuedent Group
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('levels')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Levels
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('deleteStudents')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Delete Student Group
                                    </a>
                            </li>
                            
                        </ul>
                            
                            
                        <li><a href="{{url('faculties')}}">
                                <span data-toggle="collapse" href="#faculty-links"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                                <svg class="glyph stroked notepad"><use xlink:href="#stroked-notepad"></use></svg> Faculties
                            </a></li>
                        <ul class="children collapse" id="faculty-links">
                            <li>
                                    <a class="" href="{{url('addFaculties')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Faculty
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('facultyDepartment')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Faculty's Department
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('deleteFaculties')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Delete Faculty
                                    </a>
                            </li>
                             <li>
                                    <a class="" href="{{url('addDepartments')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Department
                                    </a>
                            </li>
                             <li>
                                    <a class="" href="{{url('departmentFaculty')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Department's Faculty
                                    </a>
                            </li>
                             <li>
                                    <a class="" href="{{url('deleteDepartments')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Delete Department
                                    </a>
                            </li>
                            
                        </ul>
                         <li><a href="{{URL::to('dayPeriods')}}">
                            <span data-toggle="collapse" href="#day-links"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                            <svg class="glyph stroked dashboard dial"><use xlink:href="#stroked-dashboard-dial"/></svg> Days & Periods
                            </a></li>
                        <ul class="children collapse" id="day-links">
                            <li>
                                    <a class="" href="{{url('manageDays')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Manage Days
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('manageTimes')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Manage Times
                                    </a>
                            </li>
                            <li>
                                    <a class="" href="{{url('managePeriods')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Manage Periods
                                    </a>
                            </li>
                             <li>
                                    <a class="" href="{{url('deletePeriods')}}">
                                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Delete Periods
                                    </a>
                            </li>
                        </ul>    
			<li><a href="{{URL::to('schedules')}}"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg> Schedules</a></li>
			<li><a href="#"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
						</a>
					</li>
				</ul>
			</li>
			<li role="presentation" class="divider"></li>
			<li><a href="{{url('login')}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
	<div class="row">
            <h3>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp; &nbsp;&nbsp;&nbsp&nbsp; &nbsp;&nbsp;&nbsp&nbsp; &nbsp;&nbsp;&nbsp&nbsp; &nbsp;&nbsp;&nbsp&nbsp; &nbsp;&nbsp;&nbsp @yield('header')</h3>
        </div>
    <div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget">
                                    <div class="row no-padding">
                                            <div class="col-sm-3 col-lg-5 widget-left">
                                                <svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>
                                            </div>
                                            <div class="col-sm-9 col-lg-7 widget-right">
                                                    <div class="large">-</div>
                                                    <div class="text-muted"><a href="{{ URL::to('addHalls') }}" class="">Add Halls</a></div>
                                            </div>
                                    </div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
                                                    <svg class="glyph stroked upload"><use xlink:href="#stroked-upload"/></svg>

						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">@yield('include_num')</div>
                                                        <div class="text-muted"><a href="{{ URL::to('includeHalls') }}" class="">Include Halls</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
                                                    <svg class="glyph stroked eye"><use xlink:href="#stroked-eye"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">@yield('exclude_num')</div>
							<div class="text-muted"><a href="{{ URL::to('removeHalls') }}">Exclude Halls</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
                                                    <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg>
                                                </div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">-</div>
                                                        <div class="text-muted"><a href="{{ URL::to('deleteHalls') }}">Delete Halls</a></div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		@if(Session::has('message'))
                <p class ="alert bg-success"><svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>{{Session::get('message')}}</p>
            @endif
            @if(Session::has('error'))
                <p class ="alert bg-danger"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>{{Session::get('error')}}</p>
            @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					@yield('content')
				</div>
			</div>
		</div><!--/.row-->
		
			
		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="{!! asset('js/jquery-1.11.1.min.js') !!}"></script>
	<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
	<script src="{!! asset('js/chart.min.js') !!}"></script>
	<script src="{!! asset('js/chart-data.js') !!}}"></script>
	<script src="{!! asset('js/easypiechart.js') !!}"></script>
	<script src="{!! asset('js/easypiechart-data.js') !!}"></script>
	<script src="{!! asset('js/bootstrap-datepicker.js') !!}"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>

