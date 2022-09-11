@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <a href="{{route('add.slider')}}">
                    <button class="btn btn-info">Add Slider</button>
                </a>
              </div>
              <div class="col-md-12">
                <div class="card">
                  
                  <div class="card-header">All Slide</div>


                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" width="5%">SL No</th>
                            <th scope="col" width="15%">Title</th>
                            <th scope="col" width="15%">Description</th>
                            <th scope="col" width="15%">Image</th>
                            <th scope="col" width="15%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php($i = 1)
                          @foreach($sliders as $slider)
                            <tr>
                              <th scope="row">{{$i++}}</th>
                              <td>{{$slider->title}}</td>
                              <td>{{$slider->description}}</td>
                              <td> <img src="{{asset($slider->image)}}" style="height:40px; width: 70px;"> </td>
                              <td>
                                <a href="{{ url('edit/slider/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{url('delete/slider/'.$slider->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
              </div>



            </div>
        </div>

    </div>
@endsection
