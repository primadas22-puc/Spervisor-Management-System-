@extends('admin.layouts.default')
@section('abcd')
 
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Create Section</h1>
         
        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                         Create Section</i>
                                    </a>
                                    <!-- @if(Session::has('error'))
                                <div class="alert alert-error">
                                   <strong>{{Session::get('error')}}</strong>
                                </div>
                                @endif
                                @if(Session::has('success'))
                                <div class="alert alert-success">
                                   <strong>{{Session::get('success')}}</strong>
                                </div>
                                @endif -->
                                    <div class="modal" id="myModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Create Section</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="user" >
                                                <div class="form-group">
                                           <select class="form-select form-control-user py-3 w-100 px-3" name="session_name"
                                                    id="session_name">

                                                </select>
                                            </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-user" name="section_name" id="section_name"
                                                                placeholder="Enter Section Name">
                                                        </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" id="submit" class="btn btn-success" data-dismiss="modal">Create</button>
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
    <script>
                $(document).ready(function() {
                    getAllSessions();
            //get all sessions
            function getAllSessions() {
                var str = ""
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/show-session-list',
                    type: 'GET',
                    dataType: "json",
                    success: function(result) {
                        console.log(result);
                        if (result.status == 'success') {
                            var data = result.data;
                            console.log(data);
                            var str = '<option selected>Selected Session</option>';
                            var lent = result.data.length;
                            for (var i = 0; i < lent; i++) {
                                console.log(data[i].id);
                                str +=
                                    `<option value="${data[i].id}">${data[i].session_name}</option>`
                            }
                            $("#session_name").append(str);
                        } else if (result.status == 'error') {
                            str +=
                                `<option>${result.message}</option>`;
                            $("#session_name").append(str);
                        }
                    }
                });
            }
            $('#submit').click(function() {
                var session_name = $('#session_name').val();
                var section_name = $('#section_name').val();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var str = ''
                $("#reg").empty();
                if (session_name==''||section_name == '') {
                    alert('Please fill all fields');
                } else {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/store-section',
                        type: 'POST',
                        dataType: "json",
                        data: {
                            session_name: session_name,
                            section_name: section_name,
                        },
                        success: function(result) {
                            if (result.status == 'success') {
                                 alert('section Created Successfully');
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
                }
            });
        });
    </script>

@endsection