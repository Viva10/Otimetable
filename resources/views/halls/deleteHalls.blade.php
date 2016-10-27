@extends('master')

@section('title')
    Delete a Hall
@endsection
@section('header')
<p class ="alert bg-warning"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Deleting a hall completely removes it from the database.</p>
@endsection

@section('content')
<div class="panel-heading">Table of All Halls </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort halls
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                  <li><a href="#">Hall Capacity</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover" style="background: url('images/ttglogo1.jpg') center">
                <tr>
                    <th>N0.</th>
                    <th>Hall Name</th>
                    <th>Hall Capacity</th>
                    <th>Date Added</th>
                    <th>Exclude Hall</th>
                </tr>
                
                @foreach($halls as $hall)
                    
                    <tr style="background-color: @if($hall->hall_availability == 0)#eeeeee @endif">
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{$hall->hall_name}}</td>
                        <td>{{$hall->hall_capacity}}</td>
                        <td>{{date('l, F d Y H:i', strtotime($hall->created_at))}}</td>
                        <td><a href="{{ URL::to('deleteHall/'.$hall->id) }}" onclick="return confirm('Are you sure you want to delete this hall?')"><button type = "button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" style="color:color"></span> Delete</button></a> </td>
                    </tr>
                    
                @endforeach
            </table>
        </div>
        {!!$halls->render()!!}
    </div><!--/.row-->


@endsection