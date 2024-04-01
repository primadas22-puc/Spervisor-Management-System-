<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
  
<h1 class="text-center text-success">Student Registration page</h1>
<br/>
<div id="reg">

</div>
<div class="col-sm-12">
<!-- Student -->
<form>
   @csrf
  <div class="form-group">
    <label for="Name">Name:</label>
    <input type="text" class="form-control" name="name2" id="name2" placeholder="Enter Your Name">
  </div>
  <div class="form-group">
    <label for="Name">Student ID:</label>
    <input type="number" class="form-control" name="student_id" id="student_id" placeholder="Enter Student ID">
  </div>
  
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email2" id="email2" placeholder="Enter Your Email">
  </div>

  <div class="form-group">
    <label for="">Password:</label>
    <input type="password" class="form-control" name="password2" id="password2" placeholder="Enter your password">
  </div>

  <div class="form-group">
    <label for="pwd">Confirm Password:</label>
    <input type="password" class="form-control" name="confirm2" id="confirm2" placeholder="Confirm your password">
  </div>

  <button type="submit" id="submit2" class="btn btn-default">Register</button>

</form>
<br/>
<a href="{{url('student-login')}}" class="pull-right btn btn-block btn-success" > Already Registered ?   </a>

    </div>
   </div>
  </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
     $(document).ready(function() {
            $('#submit2').click(function() {
              $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
                let name2 = $('#name2').val();
                let student_id = $('#student_id').val();
                let email2 = $('#email2').val();
                var password2= $('#password2').val();
                var confirm2 = $('#confirm2').val();
                var role='student';
                var str = ''
                $("#reg").empty();
                if (name2 == '' || student_id == '' || email2 == '' || role == '' || password2 == '' ||
                    confirm2 == '') {
                    alert('Please fill all the fields');
                } else if (password2 != confirm2) {
                    alert('Password dont not match');
                } else {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/register-store-student',
                        method: "POST",
                        data: {
                            name: name2,
                            student_id: student_id,
                            email: email2,
                            role: role,
                            password: password2,
                        },
                        success: function(result) {
                            if (result.status == 'success') {
                                str +=
                                    `<div class="alert alert-success" role="alert" id="reg"><strong>Account Created Successfully. Please Wait for admin approvel. </strong></div>`;
                                $("#reg").append(str);
                                 $("#submit").reset();
                                alert('Registration success');
                                window.location.href = "{{ url('login') }}";
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