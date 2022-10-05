@extends('admin.master_admin')

@section('content')
<div class="content-wrapper">
  <div class="container-full">
    <!-- Content Header (Page header) -->
    <section class="content">

      <!-- Basic Forms -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Add User</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col">
              <form method="POST" action="{{ route('password.update')}}" novalidate="">
                @csrf
                <div class="row">
                  <div class="col-12">



                        <div class="form-group">
                          <h5>Current Password <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input type="password" id="current_password" name="current_password" class="form-control">
                            <div class="form-control-feedback">
                              @error('current_password')
                                  <small> {{ $message }} </small>
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <h5>New Password <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input id="password" type="password" name="password" class="form-control" >
                            <div class="form-control-feedback">
                              @error('password')
                                  <small> {{ $message }} </small>
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <h5>Confirm Password <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" >
                            <div class="form-control-feedback">
                              @error('password_confirmation')
                                  <small> {{ $message }} </small>
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror
                            </div>
                          </div>
                        </div>




                  <div class="text-xs-right">
                    <input type="submit" class="btn btn-info btn-rounded mb-5" value="Submit">
                  </div>
                  </div>
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
