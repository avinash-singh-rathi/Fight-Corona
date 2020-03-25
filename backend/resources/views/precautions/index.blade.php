@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Precautions <span class="float-right"><a href="{{route('precautions.create')}}">Create Precaution</a></span></div>
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
                  @if(!$precautions->isEmpty())
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Precaution</td>
                          <td>image</td>
                          <td colspan = 2>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($precautions as $precaution)
                        <tr>
                            <td>{{$precaution->id}}</td>
                            <td>{{$precaution->name}}</td>
                            <td><img height="50" src="{{ asset($precaution->image) }}"></td>
                            <td>
                                <a href="{{ route('precautions.edit',$precaution->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form onsubmit="return ConfirmDelete()" action="{{ route('precautions.destroy', $precaution->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $precautions->links() }}
                  @else

                  <div class="">
                    Not having any symptom. Please create <a href="{{route('precautions.create')}}">one</a>.
                  </div>

                  @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
