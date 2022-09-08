@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
  <div class="card card-default">
    <div class="card-header card-header-border-bottom">
      <h2>Edit Slider</h2>
    </div>
    <div class="card-body">
      <form action="{{ url('update/slider/'.$slide->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="old_img" value="{{$slide->image}}">
        <div class="form-group">
          <label for="exampleFormControlInput1">Title</label>
          <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" value="{{$slide->title}}">
          @error('title')
              <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$slide->description}}</textarea>
          @error('description')
              <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="exampleFormControlFile1">Image</label>
          <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
        </div>

        <div class="form-group">
          <img src="{{asset($slide->image)}}" style="height:200px; width:400px;">
        </div>

        <div class="form-footer pt-4 pt-5 mt-4 border-top">
          <button type="submit" class="btn btn-primary btn-default">Submit</button>
        </div>
      </form>
    </div>
  </div>


</div>

@endsection
