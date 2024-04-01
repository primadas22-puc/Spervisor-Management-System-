<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<style type="text/css">
  
body{
  background-image: url(http://www.joburgchiropractor.co.za/images/background.jpg);
  background-repeat: no-repeat;
  background-size: cover;
}
</style>

</head>
<body>


<div class="container" style="margin-top: 5%;">
  <div class="row">
    <div class="col-sm-4"> </div>
<div class="col-md-4">
  
<h1 class="text-center text-success">Teacher Registration</h1>
<br/>
<div id="reg">

</div>
<div class="col-sm-12">
<!-- Teacher -->
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">    
<form>
  @csrf
  <div class="form-group">
    <label for="">Name:</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
  </div>

  <div class="form-group">
    <label for="Name">Teacher ID:</label>
    <input type="number" class="form-control" name="teacher_id" id="teacher_id" placeholder="Enter Teacher ID">
  </div>
  
  <div class="form-group">
    <label for="">Email address:</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
  </div>

  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
  </div>

  <div class="form-group">
    <label for="confirm">Confirm Password:</label>
    <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm your password">
  </div>

  <button type="submit" id="submit" class="btn btn-default btn-lg">Register</button>

</form>
<br/>
<a href="{{url('teacher-login')}}" class="pull-right btn btn-block btn-success" > Already Registered ?   </a>

    </div>
   </div>
  </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
     $(document).ready(function() {
            $('#submit').click(function() {
              $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
                let name = $('#name').val();
                let teacher_id = $('#teacher_id').val();
                let email = $('#email').val();
                var password = $('#password').val();
                var confirm = $('#confirm').val();
                var role='teacher';
                var str = '';
                $("#reg").empty();
                if (name == '' || teacher_id == '' || email == '' || role == '' || password == '' ||
                    confirm == '') {
                    alert('Please fill all the fields');
                } else if (password != confirm) {
                    alert('Password not match');
                } else {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/register-store-teacher',
                        method: "POST",
                        data: {
                            name: name,
                            teacher_id: teacher_id,
                            email: email,
                            role: role,
                            password: password,
                        },
                        success: function(result) {
                            if (result.status == 'success') {
                                str +=
                                    `<div class="alert alert-success" role="alert" id="reg"><strong>Account Created Successfully. Please Wait for admin approvel. </strong></div>`;
                                $("#reg").append(str);
                            } else {
                                str +=
                                    `<div class="alert alert-success" role="alert" id="reg"><strong>Account Not Created</strong></div>`;
                                $("#reg").append(str);
                            }
                        }
                    });
                }
            });
        });
</script>
</body>
</html>