<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  
                  <div class="card-header">All Category</div>

                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php($i = 1)
                          @foreach($categories as $category)
                            <tr>
                              <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                              <td>{{$category->category_name}}</td>
                              <td>{{$category->user->name}}</td>
                              <td>
                                @if($category->created_at == NULL)
                                  <span class="text-danger">No date set</span>
                                @else
                                  {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                @endif
                              </td>
                              <td>
                                <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{url('category/softdelete/'.$category->id)}}" class="btn btn-danger">Delete</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $categories->links() }}
                </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Add Category</div>
                  <div class="card-body">
                    <form action="{{ route('store.category') }}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('category_name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                      </div>
                      <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>
        </div>
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Trash Category</div>

                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($trashCat as $trash)
                            <tr>
                              <th scope="row">{{$trashCat->firstItem()+$loop->index}}</th>
                              <td>{{$trash->category_name}}</td>
                              <td>{{$trash->user->name}}</td>
                              <td>
                                @if($trash->created_at == NULL)
                                  <span class="text-danger">No date set</span>
                                @else
                                  {{Carbon\Carbon::parse($trash->created_at)->diffForHumans()}}
                                @endif
                              </td>
                              <td>
                                <a href="{{ url('category/restore/'.$trash->id) }}" class="btn btn-info">Restore</a>
                                <a href="{{ url('category/remove/'.$trash->id)}}" class="btn btn-danger">Delete</a>
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
</x-app-layout>
