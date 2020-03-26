@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Helplines <span class="float-right"><a href="{{route('helplines.create')}}">Create Helpline</a></span></div>
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
                  @if(!$helplines->isEmpty())
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Helpline Name</td>
                          <td>Contact</td>
                          <td colspan = 2>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($helplines as $helpline)
                        <tr>
                            <td>{{$helpline->id}}</td>
                            <td>{{$helpline->name}}</td>
                            <td>{{$helpline->contact}}</td>
                            <td>
                                <a href="{{ route('helplines.edit',$helpline->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form onsubmit="return ConfirmDelete()" action="{{ route('helplines.destroy', $helpline->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $helplines->links() }}
                  @else

                  <div class="">
                    Not having any Helpline. Please create <a href="{{route('helplines.create')}}">one</a>.
                  </div>

                  @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
