@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Lost Patients <span class="float-right"><a href="{{route('lostpatients.create')}}">Create Lost Patient</a></span></div>
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
                  @if(!$lostpatients->isEmpty())
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Patient</td>
                          <td>image</td>
                          <td colspan = 2>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lostpatients as $lostpatient)
                        <tr>
                            <td>{{$lostpatient->id}}</td>
                            <td>{{$lostpatient->name}}</td>
                            <td><img height="50" src="{{ asset($lostpatient->image) }}"></td>
                            <td>
                                <a href="{{ route('lostpatients.edit',$lostpatient->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form onsubmit="return ConfirmDelete()" action="{{ route('lostpatients.destroy', $lostpatient->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $lostpatients->links() }}
                  @else

                  <div class="">
                    Not having any Lost Patient. Please create <a href="{{route('lostpatients.create')}}">one</a>.
                  </div>

                  @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
