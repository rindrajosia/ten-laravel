@extends('admin.master_admin')

@section('content')
<div class="content-wrapper">
  <div class="container-full">
    <!-- Content Header (Page header) -->
    <section class="content">

      <!-- Basic Forms -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Edit User</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col">
              <form method="POST" action="{{ url('users/update/'.$user->id)}}" novalidate="">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <h5>User Role <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <select name="role" id="select" required="" class="form-control">
                              <option value="" disabled>Select role</option>
                              <option value="Admin" {{ ( $user->role == "Admin") ? 'selected' : '' }}>Admin</option>
                              <option value="User" {{ ( $user->role == "User") ? 'selected' : '' }}>User</option>
                            </select>

                            <div class="form-control-feedback">
                              @error('role')
                                  <small> {{ $message }} </small>
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <h5>User Name <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input value="{{ $user->name }}" type="text" name="name" class="form-control" required="" data-validation-required-message="This field is required">
                            <div class="help-block"></div>
                          </div>
                          <div class="form-control-feedback">
                            @error('name')
                                <small> {{ $message }} </small>
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <h5>User Email <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input value="{{ $user->email }}" type="email" name="email" class="form-control" required="" data-validation-required-message="This field is required">
                            <div class="form-control-feedback">
                              @error('email')
                                  <small> {{ $message }} </small>
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                  <div class="text-xs-right">
                    <input type="submit" class="btn btn-info btn-rounded mb-5" value="Submit">
                  </div>
                </form>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
    </div>
  </div>

  @endsection;
