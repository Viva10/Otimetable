@extends('master')

@section('title')
    Lecturer's Schedules
@endsection

@section('header')
    Choose Lecturer!
@endsection

@section('content')

<div class="panel form form-group" style="background-color: #eeeeee">
      <form class="form-group" method="POST" action="{{ URL::to('viewLecturerSchedule')}}">
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
                <select name="faculty" onchange="getLecturers(this)" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group">
                <label>Lecturer*</label>
                <select name="lecturer" id="lecturers" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Lecturer</option>
                    
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
                    <th>Lecturer Name</th>
                    <th>Satus</th>
                    <th>Gender</th>
                    <th>Faculty</th>

                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($lecturers as $lecturer)
                    
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td><form class="form-group" method="POST" action="{{ URL::to('viewLecturerSchedule/'.$lecturer->id)}}">
                                <b style="color: #ff6600">{{$lecturer->lecturer_name}}</b>
                             <select name="schedule" id="schedules" class="dropdown form-group-sm" required="required" style="width: 60%">
                    <option name="" value="">Select Schedule</option>
                    @foreach($schedulesList as $schedule)
                    <option name="{{$schedule->id}}" value="{{$schedule->id}}">{{$schedule->version_name}}</option>
                    @endforeach
                </select>
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <button type="submit" class="btn-xs btn-primary">View</button>
                            </form></td>
                        @if($lecturer->status == 1)
                        <td>Full time</td>
                        @endif
                        @if($lecturer->status == 0)
                        <td>Part time</td>
                        @endif 
                        
                        <td>{{$lecturer->gender}}</td>
                        
                        <td>{{App\Lecturer::getLecturerFacultyName(App\Lecturer::getLecturerFaculty($lecturer->id))}}</td>
                        
                    </tr>

                @endforeach
            </table>
        </div>
        {!!$lecturers->render()!!}
    </div><!--/.row-->


@endsection
@section('script')
<script type="text/javascript">    
        function getLecturers(that){
        $.ajax({
            url:'/getLecturers',
            type:'get',
            data:{
                'id':$(that).val()
            },
            success:function(data){
                $('#lecturers').html(data);
                console.log(data);
            },
            error:function(){
                alert('error Fetching Lecturers');
            }
        }) 
    }
</script>
@endsection
