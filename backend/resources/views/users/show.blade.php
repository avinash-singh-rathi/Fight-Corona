@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User <span class="float-right"><a href="{{URL::previous()}}">Back</a></span></div>

                <div class="card-body">
                  <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>ID:</th>
                            <td>{{$user->id}}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{$user->mobile}}</td>
                        </tr>
                        <tr>
                            <th>User Type</th>
                            <td>{{$user->user_type}}</td>
                        </tr>
                    </tbody>
                  </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
