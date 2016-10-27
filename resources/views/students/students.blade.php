@extends('masterStudent')
@section('title')
    Student Groups
@endsection
@section('header')
    Manage Student Groups and Levels
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
            <table class="table table-bordered table-hover" style="background: url('images/ttglogo1.jpg') center">
                <tr>
                    <th>N0.</th>
                    <th>Department Code</th>
                    <th>Level Name</th>
                    <th>Department Name</th>
                    <th>Faculty</th>
                    <th>Date Added</th>
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
                    </tr>

                @endforeach
            </table>
        </div>
        {!!$students->render()!!}
    </div><!--/.row-->
@endsection