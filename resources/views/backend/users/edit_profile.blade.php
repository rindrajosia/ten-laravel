@extends('admin.master_admin')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="content-wrapper">
  <div class="container-full">
    <!-- Content Header (Page header) -->
    <section class="content">

      <!-- Basic Forms -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Edit Profile</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col">
              <form method="POST" action="{{ route('profile.store')}}" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="row">

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

                    

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <h5>User Adress <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input value="{{ $user->address }}" type="text" name="address" class="form-control" required="" data-validation-required-message="This field is required">
                            <div class="form-control-feedback">
                              @error('address')
                              <small> {{ $message }} </small>
                              <span class="text-danger"> {{ $message }} </span>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <h5>User Gender <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <select name="gender" id="select" required="" class="form-control">
                              <option value="" disabled>Select gender</option>
                              <option value="Male" {{ ( $user->gender == "Male") ? 'selected' : '' }}>Male</option>
                              <option value="Female" {{ ( $user->gender == "Female") ? 'selected' : '' }}>Female</option>
                            </select>

                            <div class="form-control-feedback">
                              @error('gender')
                              <small> {{ $message }} </small>
                              <span class="text-danger"> {{ $message }} </span>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <h5>Profile Image <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input id="image" type="file" name="image" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="controls">
                            <img id="showImage" src="{{(!empty($user->image))? asset('upload/user_images/'.$user->image):url('upload/no_image.jpg')}}" style="width:100px; height:100px; border: 1px solide #000000;">
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

  <script>
    $(document).ready(function(){
      $("#image").change(function(e){
        let reader = new FileReader();
        reader.onload = function(e){
          $("#showImage").attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
      });
    });
  </script>

  @endsection;
