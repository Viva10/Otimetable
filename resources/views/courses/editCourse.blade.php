@extends('master')

@section('title')
    Edit {{$course->course_name}}
@endsection

@section('header')
<color style="color: #ff6600">Editing</color> <b style="color: blue">{{$course->course_code}}</b>
@endsection

@section('content')
<div class="panel panel-default">
    <div class="form form-group">
        <form class="form-group" method="POST"action="{{ URL::to('updateCourse/'.$course->id)}}">
            <div class="form-group">
                <label>Course Name*</label>
                <input type="text" name="course_name"value="{{$course->course_name}}" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <label>Course Code*</label>
                <input type="text" name="course_code"value="{{$course->course_code}}" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <label>Student Size*</label>
                <input type="number" name="student_size"value="{{$course->student_size}}" class="form-control" style="width:60%">
            </div>
               <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <label>Number of Periods per week*</label>
                <input type="number" name="period_number"value="{{$course->period_number}}" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <label>Type*</label>
                <select name="type" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Type</option>
                    <option name="theory" value="theory">Theory</option>
                    <option name="practical" value="practical">Practical</option>
                </select>
            </div>
                <div class="form-group">
                <label>Faculty*</label>
                <select name="faculty" onchange="getDepartments(this)"class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
             <div class="form-group">
                <label>Department*</label>
                <select name="department" id="depts" class="dropdown form-control" required="" style="width: 60%">
                    <option name="" value="">Select Department</option>
                    
                </select>
            </div>
             <div class="form-group">
                <label>Level*</label>
                <select name="level" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Level</option>
                    @foreach($levels as $level)
                    <option name="{{$level->id}}" value="{{$level->id}}">{{$level->level_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
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
                alert('error');
            }
        })
       
    }
</script>
@endsection
@endsection