@extends('master')

@section('title')
    {{App\Department_has_level::getStudentsName($student_id)}}'s Schedule
@endsection
@section('header')
Schedule for <b style='color: #0099cc'>{{App\Department_has_level::getStudentsName($student_id)}}</b>
@endsection
@section('content')
<?php use App\Course;use App\Hall;?>
<div class="container">
    <div class="table table-striped">
        <table class="table table-bordered" style="background: url('images/ttglogo1.jpg') center">
            <caption class="caption">Schedule: {{$timetable_name}}</caption>
        <form class="form-group" method="POST" action="{{ URL::to('viewStudentSchedule')}}">
          <div class="form-group">
                <label>Faculty*</label>
                <select name="faculty" onchange="getFacStudents(this)" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
            <input type="text" name="schedule" value="{{$scheduleId}}" readonly="readonly"/>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group">
                <label>Student*</label>
                <select name="student" id="students" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Student</option>
                    
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">View</button>
            </div>
        </form>
            @if($scheduleId != '')
                <a href="{{URL::to('schedules/'.$scheduleId)}}"><button  style="margin-top: -8%;margin-right: 5%;background-color: #dd0000;color: white"class="btn pull-right">View Complete Schedule</button></a>
            @endif
            
            <tr>
                <th>Days</th>
                <th>7:00-9:00</th>
                <th>9:00-11:00</th>
                <th>11:00-13:00</th>
                <th>13:00-15:00</th>
                <th>15:00-17:00</th>
                <th>17:00-19:00</th>
            </tr>
            <tr>
                <td>Monday</td>
                <td>@if(!empty($schedules[0]))
                    @foreach($schedules[0] as $schedule)
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                    @endforeach
                @endif</td>
                <td>@if(!empty($schedules[1]))
                    @foreach($schedules[1] as $schedule)
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                    @endforeach
                @endif</td>
                <td>@if(!empty($schedules[2]))
                    @foreach($schedules[2] as $schedule) 
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                    @endforeach
                @endif</td>
                <td>@if(!empty($schedules[3]))
                    @foreach($schedules[3] as $schedule)
                    
                         @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                    @endforeach
                @endif</td>
                <td>@if(!empty($schedules[4]))
                    @foreach($schedules[4] as $schedule) 
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                    @endforeach
                @endif</td>
                <td>@if(!empty($schedules[5]))
                        @foreach($schedules[5] as $schedule)
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                    @endforeach
                @endif</td>
            </tr>
            <tr>
                <td>Tuesday</td>
                <td>@if(!empty($schedules[6]))
                    @foreach($schedules[6] as $schedule)
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                    @endforeach
                @endif</td>
                <td>@if(!empty($schedules[7]))
                    @foreach($schedules[7] as $schedule) 
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                    @endforeach
                @endif</td>
                <td>@if(!empty($schedules[8]))
                    @foreach($schedules[8] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                <td>@if(!empty($schedules[9]))
                    @foreach($schedules[9] as $schedule)
                    
                       @if($schedule->course_id != '')
                           -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                <td>@if(!empty($schedules[10]))
                    @foreach($schedules[10] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                <td>@if(!empty($schedules[11]))
                    @foreach($schedules[11] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
            </tr>
            <tr>
                <td>Wednesday</td>
                <td>@if(!empty($schedules[12]))
                    @foreach($schedules[12] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                <td>@if(!empty($schedules[13]))
                    @foreach($schedules[13] as $schedule)
                    
                       @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                <td>@if(!empty($schedules[14]))
                    @foreach($schedules[14] as $schedule)
                    
                       @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                <td>@if(!empty($schedules[15]))
                    @foreach($schedules[15] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                <td>@if(!empty($schedules[16]))
                    @foreach($schedules[16] as $schedule)
                        -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                    @endforeach
                @endif</td>
                <td>@if(!empty($schedules[17]))
                    @foreach($schedules[17] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
            </tr>
            <tr>
                <td>Thursday</td>
                <td>@if(!empty($schedules[18]))
                    @foreach($schedules[18] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[19]))
                    @foreach($schedules[19] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[20]))
                    @foreach($schedules[20] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[21]))
                    @foreach($schedules[21] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[22]))
                    @foreach($schedules[22] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[23]))
                    @foreach($schedules[23] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
            </tr>
            <tr>
                <td>Friday</td>
                
                <td>@if(!empty($schedules[24]))
                    @foreach($schedules[24] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[25]))
                    @foreach($schedules[25] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[26]))
                    @foreach($schedules[26] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[27]))
                    @foreach($schedules[27] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[28]))
                    @foreach($schedules[28] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[29]))
                    @foreach($schedules[29] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
            </tr>
            <tr>
                <td>Saturday</td>
                
                <td>@if(!empty($schedules[30]))
                    @foreach($schedules[30] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[31]))
                    @foreach($schedules[31] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[32]))
                    @foreach($schedules[32] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[33]))
                    @foreach($schedules[33] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[34]))
                    @foreach($schedules[34] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
                
                <td>@if(!empty($schedules[35]))
                    @foreach($schedules[35] as $schedule)
                    
                        @if($schedule->course_id != '')
                            -{{Course::find($schedule->course_id)->course_code}} &nbsp; {{Hall::find($schedule->hall_id)->hall_name}} &nbsp;| @foreach(Course::getCourseLecturers($schedule->course_id) as $lec) {{App\Lecturer::getLecturerName($lec)}} @endforeach<br/>
                        @endif
                        @endforeach
                @endif</td>
            </tr>

        </table>
    </div>
</div>
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
