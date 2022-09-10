@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <a href="{{route('add.contact')}}">
                    <button class="btn btn-info">Add Contact</button>
                </a>
              </div>
              <div class="col-md-12">
                <div class="card">
                  @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{ session('success')}}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                  <div class="card-header">All Contacts</div>


                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" width="5%">SL No</th>
                            <th scope="col" width="15%">Address</th>
                            <th scope="col" width="15%">Email</th>
                            <th scope="col" width="15%">Phone number</th>
                            <th scope="col" width="15%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php($i = 1)
                          @foreach($contacts as $contact)
                            <tr>
                              <th scope="row">{{$i++}}</th>
                              <td>{{$contact->addresse}}</td>
                              <td>{{$contact->email}}</td>
                              <td>{{$contact->phone}}</td>
                              <td>
                                <a href="{{ url('edit/contact/'.$contact->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{url('delete/contact/'.$contact->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
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
