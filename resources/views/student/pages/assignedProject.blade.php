@extends('student.layouts.default')
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
        <th>Supervisor Name</th>
        <th>Assigned Project</th>
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
            // getAllGroups();
            // //get all semester
            // function getAllGroups() {
            //     var str = ""
            //     $.ajax({
            //         url: 'http://127.0.0.1:8000/api/show-group-list',
            //         type: 'GET',
            //         dataType: "json",
            //         success: function(result) {
            //             if (result.status == 'success') {
            //                 var data = result.data;
            //                 console.log(data);
            //                 var lent = result.data.length;
            //                 for(var i=0;i<lent;i++){
            //                     var id = data[i].id;
            //                     var student_name = data[i].student_name;
            //                     var student_id= data[i].student_id;
            //                     var member_name= data[i].member_name;
            //                     var member_id= data[i].member_id;
            //                     var parse_name = JSON.parse(member_name);
            //                     var parse = JSON.parse(member_id);
            //                     str += `<tr>
            //                     <td>${id}</td>
            //                     <td>${student_name}</td>
            //                     <td>${student_id}</td>
            //                     <td>${parse}</td>
            //                     <td>${parse_name}</td>
                                
            //                   </tr>`
                             
            //                 }
            //                 $("#t_data").append(str);
            //             }  
            //             else if (result.status == 'error') {
            //                 str +=
            //                     `<tr><td colspan="8" class="text-center">${result.message}</td></tr>`;
            //                 $("#t_data").append(str);
            //             }
            //         }
            //     });
            // }
            getSupervisor();
            //get all semester
            function getSupervisor() {
                var str = ""
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/get-supervisor',
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
                                var student_id= data[i].student_id;
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
                                
                              </tr>`
                             
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
            getAllProject();
                function getAllProject() {
                    var str = ""
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/show-project-list',
                        type: 'GET',
                        dataType: "json",
                        success: function(result) {
                            console.log(result);
                            if (result.status == 'success') {
                                var data = result.data;
                                console.log(data);
                                var str = '<option selected>Selected Project</option>';
                                var lent = result.data.length;
                                for (var i = 0; i < lent; i++) {
                                    console.log(data[i].id);
                                    str +=
                                        `<option value="${data[i].id}">${data[i].project_title}</option>`
                                }
                                $("#project_id").append(str);
                            } else if (result.status == 'error') {
                                str +=
                                    `<option>${result.message}</option>`;
                                $("#project_id").append(str);
                            }
                        }
                    });
                }
        });

</script>
@endsection