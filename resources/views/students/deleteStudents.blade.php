@extends('master')
@section('title')
   Delete Student Groups
@endsection
@section('header')
       <p class ="alert bg-warning"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Deleting a Student completely removes its record from the database.</p>

@endsection
@section('content')
    <div class="row">
        <div class="panel-heading">Table of All Student Groups</div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Students
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">level</a></li>
                  <li><a href="#">department</a></li>

                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Department Code</th>
                    <th>Level Name</th>
                    <th>Department Name</th>
                    <th>Faculty</th>
                    <th>Date Added</th>
                    <th>Delete</th>

                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($students as $student)
                    
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        
                        <td><a href="{{URL::to('studentDetail/'.$student->id)}}">{{App\Department::getDepartmentCode($student->departments_id)}}</a></td>
                                               
                        <td>{{App\Level::getLevelName($student->levels_id)}}</td>

                        <td>{{App\Department::getDepartmentName($student->departments_id)}}</td>
                        
                        <td>{{App\Department::getDeptFaculty($student->departments_id)}}</td>
                        
                        <td>{{date('F d Y H:i', strtotime($student->created_at))}}</td>
                        <td><a href="{{ URL::to('deleteStudentPage/'.$student->id.'/'.$page) }}"><button type = "button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" style="color:color"></span> Delete</button></a> </td>
                    </tr>

                @endforeach
            </table>
        </div>
        {!!$students->render()!!}
    </div><!--/.row-->
@endsection