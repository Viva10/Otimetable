@extends('master')

@section('title')
    Student Schedules
@endsection

@section('header')
    Choose Student!
@endsection

@section('content')

<div class="panel form form-group" style="background-color: #eeeeee">
      <form class="form-group" method="POST" action="{{ URL::to('viewStudentSchedule')}}">
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
                <select name="faculty" onchange="getFacStudents(this)" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group">
                <label>Students*</label>
                <select name="student" id="students" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Student</option>
                    
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">View</button>
            </div>
        </form>
  </div>
  </div>
<div class="row">
        <div class="panel-heading">Table of All Lecturers </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Lecturers
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
                    <th>Student Group</th>
                    <th>Department</th>
                    <th>Faculty</th>

                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($students as $student)
                    
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td><form class="form-group" method="POST" action="{{ URL::to('viewStudTableSchedule/'.$student->id)}}">
                                <b style="color: #ff6600">{{App\Department::getDepartmentCode($student->departments_id)}} {{App\Level::getLevelName($student->levels_id)}}</b>
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
                                               
                        <td>{{App\Department::getDepartmentName($student->departments_id)}}</td>
                        
                        <td>{{App\Department::getDeptFaculty($student->departments_id)}}</td>
                        
                    </tr>

                @endforeach
            </table>
        </div>
        {!!$students->render()!!}
    </div><!--/.row-->


@endsection
@section('script')
<script type="text/javascript">    
       function getFacStudents(that){
        $.ajax({
            url:'/getStudents',
            type:'get',
            data:{
                'id':$(that).val()
            },
            success:function(data){
                $('#students').html(data);
                console.log(data);
            },
            error:function(){
                alert('error');
            }
        })   
    }
</script>
@endsection
