@extends('master')

@section('title')
    {{App\Course::getCourseName($course)}}
@endsection

@section('header')
Select Students to assign to <b style="color: #00b3ee">{{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}</b>
@endsection

@section('content')
<div class="form form-group">
    <div class="panel-heading">Assign a Student to {{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}} </div>
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
         <form class="form-group" method="POST"action="{{ URL::to('saveAssignStudent/'.$course)}}">           
            <div class="form-group">
                <label>Faculty*</label>
                <select name="faculty" onchange="getDepartments(this)" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group">
                <label>Department*</label>
                <select name="department" id="depts" onchange="getStudents(this)" class="dropdown form-control" required="" style="width: 60%">
                    <option name="" value="">Select Department</option>
                    
                </select>
            </div>
            <div class="form-group">
                <label>Students*</label>
                <select name="student" id="students" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Students</option>
                    
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
      
      function getStudents(that){
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
