@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Symptoms <span class="float-right"><a href="{{route('symptoms.create')}}">Create Symptom</a></span></div>
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
                  @if(!$symptoms->isEmpty())
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Symptom</td>
                          <td>image</td>
                          <td colspan = 2>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($symptoms as $symptom)
                        <tr>
                            <td>{{$symptom->id}}</td>
                            <td>{{$symptom->name}}</td>
                            <td><img height="50" src="{{ asset($symptom->image) }}"></td>
                            <td>
                                <a href="{{ route('symptoms.edit',$symptom->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form onsubmit="return ConfirmDelete()" action="{{ route('symptoms.destroy', $symptom->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $symptoms->links() }}
                  @else

                  <div class="">
                    Not having any symptom. Please create <a href="{{route('symptoms.create')}}">one</a>.
                  </div>

                  @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
