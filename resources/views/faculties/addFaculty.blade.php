@extends('master')

@section('title')
    Faculties
@endsection

@section('header')
    Manage Faculties
@endsection

@section('content')

<div class="panel form form-group" style="background-color: #eeeeee">
      <form class="form-group" method="POST" action="{{ URL::to('saveFaculty')}}">
          <div class="form">
              <h4 style="color: #2b669a">Add New Faculty!</h4>
            <div class="form-group">
                <label>Faculty Name*</label>
                <input type="text" name="faculty_name" placeholder="faculty name" required="" class="form-control" style="width:60%" />
            </div>
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Faculty</button>
            </div>
            
      </form>
  </div>
  </div>
<div class="row">
        <div class="panel-heading">Table of All Faculties </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Faculties
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Faculty Name</th>
                    <th>Date Added</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($faculties as $faculty)
                                        
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{$faculty->faculty_name}}</td>
                        <td>{{date('F d Y H:i', strtotime($faculty->created_at))}}</td>
                   </tr>

                @endforeach
            </table>
        </div>
        {!!$faculties->render()!!}
    </div><!--/.row-->


@endsection

