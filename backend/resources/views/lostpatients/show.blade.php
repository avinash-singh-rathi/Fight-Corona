@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{route('lostpatients.index')}}">Lost Patient</a> <span class="float-right"><a href="{{URL::previous()}}">Back</a></span></div>

                <div class="card-body">
                  <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>ID:</th>
                            <td>{{$lostpatient->id}}</td>
                        </tr>
                        <tr>
                            <th>Subject:</th>
                            <td>{{$lostpatient->name}}</td>
                        </tr>
                        <tr>
                            <th>Message:</th>
                            <td>{{$lostpatient->message}}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                              @if($lostpatient->image)
                                <img height="200" src="{{$lostpatient->image_url}}">
                              @endif
                            </td>
                        </tr>
                    </tbody>
                  </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
