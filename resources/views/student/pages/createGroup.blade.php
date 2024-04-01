@extends('student.layouts.default')
@section('abcd')

<style type="text/css">
  
body{
  background-image: url(http://www.joburgchiropractor.co.za/images/background.jpg);
  background-repeat: no-repeat;
  background-size: cover;
}
</style>

 <div class="container" style="margin-top: 5%;">
  <div class="row">
    <div class="col-sm-4"> </div>
<div class="col-md-4">
  <div id="reg">

  </div>
<h1 class="text-center">Create Group</h1>
<br/>
<div class="col-sm-12">
    <form class="user">
      <div class="form-group">
         <label for="">No. of Group Members:</label>
                <select id="group">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>              
      </div>
      <div class="form-group">
        <div id="alltext">

        </div>
                
      </div>
      
    </form>
    <button id="submit" class="btn btn-success mt-3" type="submit">Create</button> 
   </div>
  </div>
</div>
</div>



</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.js"
        integrity="sha512-NXopZjApK1IRgeFWl6aECo0idl7A+EEejb8ur0O3nAVt15njX9Gvvk+ArwgHfbdvJTCCGC5wXmsOUXX+ZZzDQw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#group").change(function () {
            var total = $("#group").val();
            var str = "";
            var str1 = "";
            for (var i = 1; i <= total; i++) {
                str +=  `
                <label for="">Group member ID</label>
                <input type="number" class="form-control form-control-user" name="member_id[]" id="member_id[]" onkeypress="getInfo()" placeholder="Enter Group Member ID">
                <label for="">Group member Name</label>
                <input type="text" class="form-control form-control-user" name="member_name[]"  id="member_name[]" placeholder="Enter Group Member Name">         
                `;
               
            }
            $("#alltext").html(str);
        });

        $("#submit").click(function(){
          $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
          var member_name =[];
          var member_id =[];
          var member_name =$("input[name='member_name[]']").map(function(){
            return $(this).val();
          }).get();
          var member_id =$("input[name='member_id[]']").map(function(){
            return $(this).val();
          }).get();
           
         
          $.ajax({
                        url: 'http://127.0.0.1:8000/api/register-group',
                        method: "POST",
                        data: {
                            member_name: member_name,
                            member_id: member_id,

                        },
                        success: function(result) {
                          if (result.status == 'success') {
                                 alert('Group Created Successfully');
                                str +=
                                    `<div class="alert alert-success" role="alert" id="reg"><strong>${result.message}</strong></div>`;
                                $("#reg").append(str);
                            } else if (result.status == 'error') {
                                alert('An Error Occured');
                                str +=
                                    `<div class="alert alert-success" role="alert" id="reg"><strong>${result.message}</strong></div>`;
                                $("#reg").append(str);
                                
                            } else if (result.status == 'err') {
                                alert('An Error Occured');
                                str +=
                                    `<div class="alert alert-success" role="alert" id="reg"><strong>${result.message}</strong></div>`;
                                $("#reg").append(str);
                            }
                        }
                    });
        });
    //   function getInfo(){
    //     var studentInfo = $(this).val();
    //     console.log(studentInfo);
    //   }
   });
</script>
@endsection




