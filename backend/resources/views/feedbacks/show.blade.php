@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{route('feedbacks.index')}}">All Feedbacks</a> <span class="float-right"><a href="{{URL::previous()}}">Back</a></span></div>

                <div class="card-body">
                  <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>ID:</th>
                            <td>{{$feedback->id}}</td>
                        </tr>
                        <tr>
                            <th>Subject:</th>
                            <td>{{$feedback->subject}}</td>
                        </tr>
                        <tr>
                            <th>Message:</th>
                            <td>{{$feedback->message}}</td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td><a href="{{route('users.show',$feedback->user_id)}}">{{$feedback->user->name}}</a></td>
                        </tr>
                    </tbody>
                  </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
