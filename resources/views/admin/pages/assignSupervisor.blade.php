@extends('admin.layouts.default')
@section('abcd')
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
        <th>Assign Supervisor</th>
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
                    url: 'http://127.0.0.1:8000/api/show-allGroup-list',
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
                                
                                w`
                               str += `<td>
                               <form class="user">
                               <div class="form-group">
                                                        <select class="form-select form-control-user py-3 w-100 px-3" name="supervisor_id"
                                                            id="supervisor_id" > 
                                                        </select>
                                                    </div>
                                                </form>                                       
                                    
                                </td>
                                <td>
                                <button id="submit"  value="${data[i].id}" class="btn btn-success">Save</button>
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
            getAllSupervisor();
                function getAllSupervisor() {
                    var str = ""
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/show-supervisor-list',
                        type: 'GET',
                        dataType: "json",
                        success: function(result) {
                            console.log(result);
                            if (result.status == 'success') {
                                var data = result.data;
                                console.log(data);
                                var str = '<option selected>Selected Supervisor</option>';
                                var lent = result.data.length;
                                for (var i = 0; i < lent; i++) {
                                    console.log(data[i].id);
                                    str +=
                                        `<option value="${data[i].id}">${data[i].name}</option>`
                                }
                                $("#supervisor_id").append(str);
                            } else if (result.status == 'error') {
                                str +=
                                    `<option>${result.message}</option>`;
                                $("#supervisor_id").append(str);
                            }
                        }
                    });
                }
                $(document).on('click', '#submit', function () {
                        var id = $('#submit').val();
                    var supervisor_id = $("#supervisor_id").val();
                    console.log(id);
                    console.log(supervisor_id);
                $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
                var str = ''
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/store-supervisorAssign',
                        type: 'POST',
                        dataType: "json",
                        data: {
                            owner_id: id,
                            supervisor_id: supervisor_id,
                        },
                        success: function(result) {
                            if (result.status == 'success') {
                                 alert('Supervisor Assigned');
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
        });

</script>
@endsection