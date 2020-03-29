@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Feedbacks <span class="float-right"><a href="{{route('home')}}">Back</a></span></div>
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
                  @if(!$feedbacks->isEmpty())
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Subject</td>
                          <td>User</td>
                          <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{$feedback->id}}</td>
                            <td>{{$feedback->subject}}</td>
                            <td>{{$feedback->user->name}}</td>
                            <td>
                                <a href="{{ route('feedbacks.show',$feedback->id)}}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $feedbacks->links() }}
                  @else

                  <div class="">
                    Not having any Feedbacks.
                  </div>

                  @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
