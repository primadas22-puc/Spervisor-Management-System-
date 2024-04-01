@extends('student.layouts.default')
@section('abcd')
<style type="text/css">
  
body{
  background-image: url(http://www.joburgchiropractor.co.za/images/background.jpg);
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
</div>
<table class="table">
  <thead class="thead-light">
  <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Student ID</th>
        <th>Group Member ID</th>
        <th>Group Member Name</th>
        <th>Action</th>
  </tr>
  </thead>
  <tbody id='t_data'>
</tbody>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.js"
integrity="sha512-NXopZjApK1IRgeFWl6aECo0idl7A+EEejb8ur0O3nAVt15njX9Gvvk+ArwgHfbdvJTCCGC5wXmsOUXX+ZZzDQw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


<script>
        $(document).ready(function() {
            getAllGroups();
            //get all semester
            function getAllGroups() {
                var str = ""
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/show-group-list',
                    type: 'GET',
                    dataType: "json",
                    success: function(result) {
                        if (result.status == 'success') {
                            var data = result.data;
                            console.log(data);
                            var lent = result.data.length;
                            for(var i=0;i<lent;i++){
                                var id = data[i].id;
                                var student_name = data[i].student_name;
                                var student_id = data[i].student_id;
                                var member_name= data[i].member_name;
                                var member_id= data[i].member_id;
                                var parse_name = JSON.parse(member_name);
                                var parse = JSON.parse(member_id);
                                str += `<tr>
                                <td>${id}</td>
                                <td>${student_name}</td>
                                <td>${student_id}</td>
                                <td>${parse}</td>
                                <td>${parse_name}</td>
                                
                                `
                                // var parse = JSON.parse(member_id);
                            //    for(var j=0;j<parse.length;j++){
                            //     var parse_name = JSON.parse(member_name);
                            //        str += `<td>${parse[j]}</td>
                            //        <td>${parse_name[j]}</td>
                            //        `
                            //    }
                               str += `<td>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModalone${data[i].id}">
                                        Delete
                                    </a>
                                    <div class="modal" id="myModalone${data[i].id}">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Delete Confirmation</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                            Are you sure to delete <b>${data[i].project_title}</b> account?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <a id="submit" value="${data[i].id}" class="btn btn-success">Delete</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                </td>
                                    </td>`
                          str += `</tr>`
                             
                            }
                            $("#t_data").append(str);
                        }  
                        else if (result.status == 'error') {
                            str +=
                                `<tr><td colspan="8" class="text-center">${result.message}</td></tr>`;
                            $("#t_data").append(str);
                        }
                    }
                });
            }
            // Delete group
            $(document).on('click', '#submit', function() {
                var id = $(this).attr('value');
                console.log(id);
                $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
                $.ajax({
                    url: `http://127.0.0.1:8000/api/group-list-delete/${id}`,
                    type: 'POST',
                    dataType: "json",
                    success: function(result) {
                        $("#myModalone" + id).modal('hide');
                        if (result.status == 'success') {
                            Toastify({
                                text: result.message,
                                className: "succes",
                                duration: 3000,
                            }).showToast();
                            setTimeout(() => {
                                window.location.reload();
                                // getAllCourses();
                            }, 1000);
                        } else if (result.status == 'error') {
                            Toastify({
                                text: result.message,
                                className: "danger",
                                duration: 3000,
                            }).showToast();
                        }
                    }
                });
            });
        });
</script>

@endsection