@extends('admin.layouts.default')
@section('abcd')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Total Students</h1>
</div>
<table class="table">
  <thead class="thead-light">
  <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Student ID</th>
        <th>Role</th>
        <th>Status</th>
  </tr>
  </thead>
  <tbody>
      @if($totalStudentList)
            @foreach ($totalStudentList as $tsl)
            <tr>
                <td>{{$tsl->name}}</td>
                <td>{{$tsl->email}}</td>
                <td>{{$tsl->student_id}}</td>
                <td>{{$tsl->role}}</td>
                <td>
                    @if($tsl->active == 1)
                        <span class="badge badge-success">Approved</span>
                    
                    @else
                        <span class="badge badge-danger">Pending</span>
                    
                    @endif
                </td>
            </tr>
            @endforeach
        @endif
  </tbody>
</table>
@endsection
