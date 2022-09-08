@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
  <div class="card card-default">
    <div class="card-header card-header-border-bottom">
      <h2>Edit About</h2>
    </div>
    <div class="card-body">
      <form action="{{ url('update/about/'.$about->id) }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Title</label>
          <input type="text" name="title" value="{{$about->title}}" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title">
          @error('title')
              <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Short description</label>
          <textarea name="short_description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$about->short_description}}</textarea>
          @error('short_description')
              <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Long description</label>
          <textarea name="long_description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$about->long_description}}</textarea>
          @error('long_description')
              <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>
        <div class="form-footer pt-4 pt-5 mt-4 border-top">
          <button type="submit" class="btn btn-primary btn-default">Submit</button>
        </div>
      </form>
    </div>
  </div>


</div>

@endsection
