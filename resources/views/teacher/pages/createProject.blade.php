@extends('teacher.layouts.default')
@section('abcd')
<style type="text/css">
  
body{
  background-image: url(http://www.joburgchiropractor.co.za/images/background.jpg);
  background-repeat: no-repeat;
  background-size: cover;
}

</style>

<div class="container" style="margin-top:30px">
@if(Session::has('info'))
  <div class="alert alert-error">
    <strong>{{Session::get('info')}}</strong>
  </div>
@endif
<div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Create Project</div>
                            <div class="card-body">

                                <form class="form-horizontal" method="post" action="{{ url('register-project')}}">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Project Title</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="project_title" id="project_title" placeholder="Enter Project Title" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Project Description</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <textarea name="project_description" id="project_description" cols="100" rows="10" placeholder="Enter Project Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <button type="submit" id="submit" class="btn btn-primary btn-lg btn-block login-button">Create Project</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
</div>


@endsection