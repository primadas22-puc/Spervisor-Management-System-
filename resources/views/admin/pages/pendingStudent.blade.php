@extends('admin.layouts.default')
@section('abcd')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pending Students</h1>
</div>
<table class="table">
  <thead class="thead-light">
  <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
  </tr>
  </thead>
  <tbody>
      @if($pendingStudentList)
            @foreach ($pendingStudentList as $psl)
            <tr>
                <td>{{$psl->name}}</td>
                <td>{{$psl->email}}</td>
                <td>{{$psl->role}}</td>
                <td>
                    @if($psl->active == 1)
                        <span class="badge badge-success">Approved</span>
                    
                    @else
                        <span class="badge badge-danger">Pending</span>
                    
                    @endif
                </td>
                <td>
               <!-- Edit  -->
            <a href="{{ url('update-pendingStudent/'.$psl->id) }}" class="btn btn-success" data-toggle="modal" data-target="#myModal2{{$psl->id}}"><i class="fas fa-check"></i></a>
              <!-- The Modal -->
              <div class="modal" id="myModal2{{$psl->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Approval</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      you want to change the status of <b>{{$psl->name}}</b>?
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      <a href="{{ url('update-pendingStudent/'.$psl->id) }}" class="btn btn-success">yes</a>
                    </div>

                  </div>
                </div>
              </div>
          
             <!-- Delete -->
              <a href="{{ url('delete-pendingStudent/'.$psl->id) }}" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$psl->id}}"> <i class="fas fa-trash"></i></a>
              <!-- The Modal -->
              <div class="modal" id="myModal{{$psl->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Delete Confirmation</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      Are you sure to delete <b>{{$psl->name}}</b>?
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      <a href="{{ url('delete-pendingStudent/'.$psl->id) }}" class="btn btn-success">yes</a>
                    </div>

                  </div>
                </div>
              </div>
            </td>
            </tr>
            @endforeach
        @endif
  </tbody>
</table>





@endsection