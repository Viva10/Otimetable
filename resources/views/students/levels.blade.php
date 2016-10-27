@extends('master')

@section('title')
    Levels
@endsection

@section('header')
    Manage Levels
@endsection

@section('content')

<div class="panel form form-group" style="background-color: #eeeeee">
      <form class="form-group" method="POST" action="{{ URL::to('saveLevel')}}">
          <div class="form">
              <h4 style="color: #2b669a">Add New Level!</h4>
            <div class="form-group">
                <label>Level Name*</label>
                <input type="text" name="level_name" placeholder="X00" required="" class="form-control" style="width:60%" />
            </div>
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Level</button>
            </div>
            
      </form>
  </div>
  </div>
<div class="row">
        <div class="panel-heading">Table of All Levels </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Levels
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                  <li><a href="#">code</a></li>
                  <li><a href="#">student size</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Level Name</th>
                    <th>Date Added</th>
                    <th>Delete</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($levels as $level)
                                        
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{$level->level_name}}</td>
                        <td>{{date('F d Y H:i', strtotime($level->created_at))}}</td>
                        <td><a href="{{ URL::to('deleteLevel/'.$level->id) }}" onclick="return confirm('Are you sure you want to delete this Level?')"><button type = "button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" style="color:color"></span> Delete</button></a> </td>
                   </tr>

                @endforeach
            </table>
        </div>
        {!!$levels->render()!!}
    </div><!--/.row-->


@endsection

