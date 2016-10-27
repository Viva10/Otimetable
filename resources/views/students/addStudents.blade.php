@extends('master')

@section('header')
    Add New Student Group
@endsection

@section('content')
    <div class="form form-group">
        <form class="form-group" method="POST" action="{{ URL::to('saveStudent')}}">
                     
            <div class="form-group">
                <label>Faculty*</label>
                <select name="faculty" onchange="getDepartments(this)"class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Department*</label>
                <select name="department" id="depts" class="dropdown form-control" required="" style="width: 60%">
                    <option name="" value="">Select Department</option>
                    
                </select>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <label>Level*</label>
                <select name="level" id="levels" class="dropdown form-control" required="" style="width: 60%">
                    <option name="" value="">Select Level</option>
                     @foreach($levels as $level)
                    <option name="{{$level->id}}" value="{{$level->id}}">{{$level->level_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
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
</script>
@endsection
@section('title')
    Add a Course
@endsection