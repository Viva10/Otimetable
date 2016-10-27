@extends('master')

@section('title')
   Create New Schedule
@endsection
@section('header')
    Creating New Schedule
@endsection
@section('content')
    <div class="panel form form-group" style="background-color: #eeeeee">
      <form class="form-group" method="POST" action="{{ URL::to('simulate')}}">
          <div class="form">
              <h4 style="color: #2b669a">Enter name of new timetable!</h4>
            <div class="form-group">
                <label>Timetable Name*</label>
                <input type="text" name="timetable_name" placeholder="Schedule name" required="" class="form-control" style="width:60%" />
            </div>
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simulate Timetable</button>
            </div>
            
      </form>
  </div>
@endsection