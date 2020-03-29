@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Sub-Districts <span class="float-right"><a href="{{route('subdistricts.create')}}">Create Sub-District</a></span></div>
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
                  @if(!$subdistricts->isEmpty())
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>District</td>
                          <td>Sub District</td>
                          <td>Pincode</td>
                          <td colspan = 2>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subdistricts as $subdistrict)
                        <tr>
                            <td>{{$subdistrict->id}}</td>
                            <td>{{$subdistrict->district->name}}</td>
                            <td>{{$subdistrict->name}}</td>
                            <td>{{$subdistrict->pincode}}</td>
                            <td>
                                <a href="{{ route('subdistricts.edit',$subdistrict->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form onsubmit="return ConfirmDelete()" action="{{ route('subdistricts.destroy', $subdistrict->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $subdistricts->links() }}
                  @else

                  <div class="">
                    Not having any Sub-District. Please create <a href="{{route('subdistricts.create')}}">one</a>.
                  </div>

                  @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
