@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Users <span class="float-right"><a href="{{route('home')}}">Back</a></span></div>
                  <div class="row">
                    <div class="col-sm-12">
                      @if(session()->get('success'))
                        <div class="alert alert-success">
                          {{ session()->get('success') }}
                        </div>
                      @endif
                    </div>
                  </div>
                <div class="card-body">
                  @if(!$users->isEmpty())
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Name</td>
                          <td>Email</td>
                          <td>Mobile</td>
                          <td>Type</td>
                          <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>{{$user->user_type}}</td>
                            <td>
                                <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $users->links() }}
                  @else

                  <div class="">
                    Not having any user. Please create <a href="{{route('users.create')}}">one</a>.
                  </div>

                  @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
