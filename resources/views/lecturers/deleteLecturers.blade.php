@extends('master')

@section('title')
    Delete a Lecturer
@endsection

@section('header')
    <p class ="alert bg-warning"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Deleting a lecturer completely removes their record from the database.</p>
@endsection

@section('content')
    <div class="row">
        <div class="panel-heading">Table of All Lecturers</div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Lecturers
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                  <li><a href="#">gender</a></li>
                  <li><a href="#">status</a></li>

                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Lecturer Name</th>
                    <th>Satus</th>
                    <th>Gender</th>
                    <th>Faculty</th>
                    <th>Date Added</th>
                    <th>Delete</th>

                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($lecturers as $lecturer)
                    
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        
                        <td>{{$lecturer->lecturer_name}}</td>
                        
                        @if($lecturer->status == 1)
                        <td>Full time</td>
                        @endif
                        @if($lecturer->status == 0)
                        <td>Part time</td>
                        @endif 
                        
                        <td>{{$lecturer->gender}}</td>
                        
                        <td>{{App\Lecturer::getLecturerFacultyName(App\Lecturer::getLecturerFaculty($lecturer->id))}}</td>
                        
                        <td>{{date('F d Y H:i', strtotime($lecturer->created_at))}}</td>
                        <td><a href="{{ URL::to('deleteLecturerPage/'.$lecturer->id) }}"><button type = "button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" style="color:color"></span> Delete</button></a> </td>
                    </tr>

                @endforeach
            </table>
        </div>
        {!!$lecturers->render()!!}
@endsection