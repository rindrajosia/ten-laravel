@extends('admin.admin_master')

@section('admin')
<div class="card card-default">
  <div class="card-header card-header-border-bottom">
    <h2>Update Profile</h2>
  </div>
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('success')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  <div class="card-body">
    <form method="post" action="{{ route('update.profile') }}" class="form-pill">
      @csrf
      <div class="form-group">
        <label for="exampleFormControlInput3">User Name</label>
        <input type="text" value="{{$user->name}}" class="form-control" name="name" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput3">Email</label>
        <input type="email" value="{{$user->email}}" class="form-control" name="email" required>
      </div>
      <button type="submit" class="btn btn-primary btn-default">Update</button>
    </form>
  </div>
</div>
@endsection
