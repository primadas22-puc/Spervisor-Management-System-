@extends('teacher.layouts.default')
@section('abcd')
<style type="text/css">
  
body{
  background-image: url(https://ibb.co/rmzRz74);
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
        <th>Project Title</th>
        <th style="width: 70%">Project Description</th>
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
            getAllProjects();
            //get all semester
            function getAllProjects() {
                var str = ""
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/show-project-list',
                    type: 'GET',
                    dataType: "json",
                    success: function(result) {
                        if (result.status == 'success') {
                            var data = result.data;
                            var lent = result.data.length;
                            for (var i = 0; i < lent; i++) {
                                str += `<tr>
                                <td>${data[i].id}</td>
                                <td>${data[i].project_title}</td>
                                <td>${data[i].project_description}</td>
                                <td>
                                <a id="edit" value="${data[i].id}" href="#" class="btn btn-primary  btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal${data[i].id}">
                                        Edit
                                    </a>
                                    <div class="modal" id="myModal${data[i].id}">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Update Project</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="user">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-user" id="project_title"
                                                                placeholder="Enter Project title">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-user" id="project_description"
                                                                placeholder="Enter Project Description">
                                                        </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <a id="updates" value="${data[i].id}" class="btn btn-success">Update</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
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
                                    </td>
                            </tr>`
                            }
                            $("#t_data").append(str);
                        } else if (result.status == 'error') {
                            str +=
                                `<tr><td colspan="8" class="text-center">${result.message}</td></tr>`;
                            $("#t_data").append(str);
                        }
                    }
                });
            }
            //specific project information
            $(document).on('click', '#edit', function() {
                var id = $(this).attr('value');
                console.log(id);
                $.ajax({
                    url: `http://127.0.0.1:8000/api/show-project-edit/${id}`,
                    type: 'GET',
                    dataType: "json",
                    success: function(result) {
                        if (result.status == 'success') {
                            var data = result.data;
                            console.log(data);
                            $("#project_title").val(data.project_title);
                            $("#project_description").val(data.project_description);
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
            //update session information
            $(document).on('click', '#updates', function() {
                var id = $(this).attr('value');
                $("#project_title").val();
                $("#project_description").val();
                $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
                console.log(id);
                $.ajax({
                    url: `http://127.0.0.1:8000/api/project-update/${id}`,
                    type: 'POST',
                    dataType: "json",
                    data: {
                        project_title: project_title,
                        project_description: project_description
                    },
                    success: function(result) {
                        $("#myModal" + id).modal('hide');
                        if (result.status == 'success') {
                            Toastify({
                                text: result.message,
                                className: "success",
                                duration: 3000,
                            }).showToast();
                            setTimeout(() => {
                                window.location.reload();
                                // getAllCourses();
                            }, 5000);
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
            // Delete semester
            $(document).on('click', '#submit', function() {
                var id = $(this).attr('value');
                console.log(id);
                $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
                $.ajax({
                    url: `http://127.0.0.1:8000/api/project-list-delete/${id}`,
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