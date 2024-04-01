@extends('student.layouts.default')
@section('abcd')

<style type="text/css">
  
body{
  background-image: url(http://www.joburgchiropractor.co.za/images/background.jpg);
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
<div class="container-fluid text-center mt-5">
  <h1>Welcome</h1>
<h3>{{$username}}</h3>
</div>
@endsection