@extends('master')

@section('title')
    Course Schedules
@endsection

@section('header')
    Choose Course!
@endsection

@section('content')

<div class="panel form form-group" style="background-color: #eeeeee">
      <form class="form-group" method="POST" action="{{ URL::to('viewCourseSchedule')}}">
            <div class="form-group">
                <label>Schedules*</label>
                <select name="schedule" id="schedules" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Schedule</option>
                    @foreach($schedulesList as $schedule)
                    <option name="{{$schedule->id}}" value="{{$schedule->id}}">{{$schedule->version_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Faculty*</label>
                <select name="faculty" onchange="getDepartments(this)" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Department*</label>
                <select name="department" id="depts" onchange="getDeptCourses(this)" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Department</option>
                </select>
            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group">
                <label>Courses*</label>
                <select name="course" id="courses" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Course</option>
                    
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">View</button>
            </div>
        </form>
  </div>
  </div>
<div class="row">
        <div class="panel-heading">Table of All Courses </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Courses
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover" style="background: url('images/ttglogo1.jpg') center">
                <tr>
                    <th>N0.</th>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>Department</th>
                    <th>Faculty</th>

                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($courses as $course)
                    
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>
                            {{App\Course::getCourseName($course->id)}}
                        </td>
                        <td><form class="form-group" method="POST" action="{{ URL::to('viewCourseTableSchedule/'.$course->id)}}">
                                <b style="color: #ff6600">{{App\Course::getCourseCode($course->id)}}</b>
                                 <select name="schedule" id="schedules" class="dropdown form-group-sm" required="required" style="width: 60%">
                                    <option name="" value="">Select Schedule</option>
                                    @foreach($schedulesList as $schedule)
                                    <option name="{{$schedule->id}}" value="{{$schedule->id}}">{{$schedule->version_name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <button type="submit" class="btn-xs btn-primary">View</button>
                            </form>
                        </td>
                                               
                        <td>{{App\Department::getDepartmentName(App\Course::getCourseDept($course->id))}}</td>
                        
                        <td>{{App\Course::getCourseFaculty($course->id)}}</td>
                        
                    </tr>

                @endforeach
            </table>
        </div>
        {!!$courses->render()!!}
    </div><!--/.row-->


@endsection
@section('script')
<script type="text/javascript">    
    function getDepartments(that){
        $.ajax({
            url:'/getDepartments',
            type:'get',
            data:{
                'id':$(that).val()
            },
            success:function(data){
                $('#depts').html(data);
                console.log(data);
            },
            error:function(){
                alert('error Fetching Departments');
            }
        })
       
    }
    function getDeptCourses(that){
         $.ajax({
            url:'/getDeptCourses',
            type:'get',
            data:{
                'id':$(that).val()
            },
            success:function(data){
                $('#courses').html(data);
                console.log(data);
            },
            error:function(){
                alert('error Fetching Courses');
            }
        })
    }
</script>
@endsection
