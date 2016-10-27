@extends('master')

@section('title')
    {{$schedule_name}}'s Schedule Report
@endsection
@section('header')
    Scheduling Report for {{$schedule_name}}
@endsection
@section('content')
    <div class="row">
        <div class="panel-heading">Report</div>
        
        <div class="table table-bordered">
            <table class="table table-bordered table-hover" style="background: url('images/ttglogo1.jpg') center">
                <tr>
                    <th>N0.</th>
                    <th>Query</th>
                    <th>State Of the Art way to add space hihi</th>
                </tr>
              
                <tr>
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Total Number of Courses</td>
                    <td>{{$fullReport->total_courses}}</td>
                </tr>
                 <tr>
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Number of Courses with DOUBLE(2) periods</td>
                    <td>{{$fullReport->double_count}}</td>
                </tr>
                 <tr>
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Number of Courses with SINGLE(1) periods</td>
                    <td>{{$fullReport->single_count}}</td>
                </tr>
                 <tr>
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Number of Double period courses Scheduled Twice</td>
                    <td>{{$fullReport->double_full_courses_scheduled_count}}</td>
                </tr>
                <tr style="color: #ff6666">
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Number of Double period courses Scheduled <b>only ONCE</b><br/>
                    @foreach($fullReport->double_half as $double_half)
                        ->{{App\Course::getCourseCode($double_half->course_id)}} with {{App\Course::getCourseStudentSize($double_half->course_id)}} students<br/>
                    @endforeach</td>
                    <td>{{$fullReport->double_half_courses_scheduled_count}}</td>
                </tr>
                 <tr>
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Number of Single period courses Scheduled</td>
                    <td>{{$fullReport->single_courses_scheduled_count}}</td>
                </tr>
                <tr>
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Double period courses success rate:</td>
                    <td>{{$fullReport->double_success}}%</td>
                </tr>
                <tr>
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Single period courses success rate:</td>
                    <td>{{$fullReport->single_success}}%</td>
                </tr>
                <tr style="color: #33cc00">
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Overall Schedule success rate:</td>
                    <td>{{$fullReport->overall_success}}%</td>
                </tr>
                
                <tr style="color: #ff6666">
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Number of Double period <b>Unscheduled</b>
                        @foreach($fullReport->double_not_scheduled as $double_not)
                            ->{{App\Course::getCourseCode($double_not->course_id)}} with {{App\Course::getCourseStudentSize($double_not->course_id)}} students
                        @endforeach
                    </td>
                    <td>{{count($fullReport->double_not_scheduled)}}</td>
                </tr>
                <tr style="color: #ff6666">
                    <td><?php $i++;
                    echo $i; ?></td>                    
                    <td>Number of Single period <b>Unscheduled</b>
                        @foreach($fullReport->single_not_scheduled as $single_not)
                            ->{{App\Course::getCourseCode($single_not->course_id)}} with {{App\Course::getCourseStudentSize($single_not->course_id)}} students
                        @endforeach
                    </td>
                    <td>{{count($fullReport->single_not_scheduled)}}</td>
                </tr>
          
            </table>
        </div>
    </div><!--/.row-->

@endsection