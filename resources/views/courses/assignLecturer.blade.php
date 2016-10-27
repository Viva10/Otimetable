@extends('master')

@section('title')
    {{App\Course::getCourseName($course)}}
@endsection

@section('header')
Select Lecturers to assign to <b style="color: #00b3ee">{{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}</b>
@endsection

@section('content')
<div class="form form-group">
    <div class="panel-heading">Assign a lecturer to {{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}} </div>
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
     <div class="form form-group">
         <form class="form-group" method="POST"action="{{ URL::to('saveAssign/'.$course)}}">           
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div><!-- -->
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
