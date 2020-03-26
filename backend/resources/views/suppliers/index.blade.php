@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Suppliers <span class="float-right"><a href="{{route('suppliers.create')}}">Create Supplier</a></span></div>
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
                  @if(!$suppliers->isEmpty())
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Supplier Name</td>
                          <td>City</td>
                          <td>Pincode</td>
                          <td colspan = 2>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{$supplier->id}}</td>
                            <td>{{$supplier->name}}</td>
                            <td>{{$supplier->city->name}}</td>
                            <td>{{$supplier->pincode}}</td>
                            <td>
                                <a href="{{ route('suppliers.edit',$supplier->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form onsubmit="return ConfirmDelete()" action="{{ route('suppliers.destroy', $supplier->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $suppliers->links() }}
                  @else

                  <div class="">
                    Not having any Supplier. Please create <a href="{{route('suppliers.create')}}">one</a>.
                  </div>

                  @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
