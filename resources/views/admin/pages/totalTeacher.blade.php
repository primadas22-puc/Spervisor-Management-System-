@extends('admin.layouts.default')
@section('abcd')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Total Teachers</h1>
</div>
<table class="table">
  <thead class="thead-light">
  <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Teacher ID</th>
        <th>Role</th>
        <th>Status</th>
  </tr>
  </thead>
  <tbody>
      @if($totalTeacherList)
            @foreach ($totalTeacherList as $ttl)
            <tr>
                <td>{{$ttl->name}}</td>
                <td>{{$ttl->email}}</td>
                <td>{{$ttl->teacher_id}}</td>
                <td>{{$ttl->role}}</td>
                <td>
                    @if($ttl->active == 1)
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