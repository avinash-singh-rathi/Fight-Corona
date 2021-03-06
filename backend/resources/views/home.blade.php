@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p>You are logged in!</p>
                    @can('isAdmin')
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-group">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Countries</h5>
                                <a href="{{route('countries.index')}}" class="card-link">All</a>
                                <a href="{{route('countries.create')}}" class="card-link">Create New</a>
                              </div>
                            </div>

                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">States</h5>
                                <a href="{{route('states.index')}}" class="card-link">All</a>
                                <a href="{{route('states.create')}}" class="card-link">Create New</a>
                              </div>
                            </div>

                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Districts</h5>
                                <a href="{{route('districts.index')}}" class="card-link">All</a>
                                <a href="{{route('districts.create')}}" class="card-link">Create New</a>
                              </div>
                            </div>

                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Sub Districts</h5>
                                <a href="{{route('subdistricts.index')}}" class="card-link">All</a>
                                <a href="{{route('subdistricts.create')}}" class="card-link">Create New</a>
                              </div>
                            </div>

                        </div>

                        <div class="card-group mt-2">

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Cities</h5>
                              <a href="{{route('cities.index')}}" class="card-link">All</a>
                              <a href="{{route('cities.create')}}" class="card-link">Create New</a>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">News</h5>
                              <a href="{{route('posts.index')}}" class="card-link">All</a>
                              <a href="{{route('posts.create')}}" class="card-link">Create New</a>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Precautions</h5>
                              <a href="{{route('precautions.index')}}" class="card-link">All</a>
                              <a href="{{route('precautions.create')}}" class="card-link">Create New</a>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Symptoms</h5>
                              <a href="{{route('symptoms.index')}}" class="card-link">All</a>
                              <a href="{{route('symptoms.create')}}" class="card-link">Create New</a>
                            </div>
                          </div>

                        </div>

                        <div class="card-group mt-2">

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">HelpLine Numbers</h5>
                              <a href="{{route('helplines.index')}}" class="card-link">All</a>
                              <a href="{{route('helplines.create')}}" class="card-link">Create New</a>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Lost/Runaway Patients</h5>
                              <a href="{{route('lostpatients.index')}}" class="card-link">All</a>
                              <a href="{{route('lostpatients.create')}}" class="card-link">Create New</a>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Feedback</h5>
                              <a href="{{route('feedbacks.index')}}" class="card-link">All</a>
                              <!-- <a href="{{route('symptoms.create')}}" class="card-link">Create New</a> -->
                            </div>
                          </div>

                        </div>

                        <div class="card-group mt-2">

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Raasan Suppliers</h5>
                              <a href="{{route('suppliers.index')}}" class="card-link">All</a>
                              <a href="{{route('suppliers.create')}}" class="card-link">Create New</a>
                            </div>
                          </div>

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Reported Patients</h5>
                              <a href="{{route('patients.index')}}" class="card-link">All</a>
                              <a href="{{route('patients.create')}}" class="card-link">Create New</a>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Users</h5>
                              <a href="{{route('users.index')}}" class="card-link">All</a>
                              <!-- <a href="{{route('users.create')}}" class="card-link">Create New</a> -->
                            </div>
                          </div>

                        </div>
                    @endcan

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
