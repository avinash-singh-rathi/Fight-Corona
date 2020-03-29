@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit User <span class="float-right"><a href="{{route('users.index')}}">Back</a></span></div>
                <div class="row mt-4">
                  <div class="col-sm-12">
                    @if(session()->get('success'))
                      <div class="alert alert-success">
                        {{ session()->get('success') }}
                      </div>
                    @endif
                  </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="iso">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required value="{{ old('email',$user->email) }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="iso">{{ __('Mobile') }}</label>
                                    <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" required value="{{ old('mobile',$user->mobile) }}">
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_type">{{ __('User Type') }}</label>
                                    <select class="form-control @error('user_type') is-invalid @enderror" name="user_type" required>
                                      <option value="">Select Type</option>
                                      <option @if(old('user_type',$user->user_type) == 'user') selected @endif value="user">User</option>
                                      <option @if(old('user_type',$user->user_type) == 'author') selected @endif value="author">Author</option>
                                      <option @if(old('user_type',$user->user_type) == 'admin') selected @endif value="admin">Admin</option>
                                    </select>
                                    @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
