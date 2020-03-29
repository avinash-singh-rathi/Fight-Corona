@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create Reported Patient <span class="float-right"><a href="{{route('patients.index')}}">Back</a></span></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('patients.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="age">{{ __('Age') }}</label>
                                    <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required>
                                    @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="country_id">{{ __('Country') }}</label>
                                    <select @change="getStates()" id="country_id" class="form-control @error('country_id') is-invalid @enderror" required name="country_id">
                                      <option value="">Select Country</option>
                                      @foreach($countries as $country)
                                      <option value="{{$country->id}}" @if(old('country_id') == $country->id) selected @endif>{{$country->name}}</option>
                                      @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="state_id">{{ __('State') }}</label>
                                    <select onchange="getDistricts()" id="state_id" class="state-select form-control @error('state_id') is-invalid @enderror" required name="state_id">
                                      <option value="">Select State</option>
                                    </select>
                                    <input type="hidden" value="{{ old('state_id') }}" name="stateme" id="stateme">
                                    @error('state_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="district_id">{{ __('District') }}</label>
                                    <select onchange="getSubDistricts()" id="district_id" class="district-select form-control @error('district_id') is-invalid @enderror" required name="district_id">
                                      <option value="">Select District</option>
                                    </select>
                                    <input type="hidden" value="{{ old('district_id') }}" name="districtme" id="districtme">
                                    @error('district_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="subdistrict_id">{{ __('Sub District') }}</label>
                                    <select onchange="getCities()" id="subdistrict_id" class="subdistrict-select form-control @error('subdistrict_id') is-invalid @enderror" required name="subdistrict_id">
                                      <option value="">Select Sub District</option>
                                    </select>
                                    <input type="hidden" value="{{ old('subdistrict_id') }}" name="subdistrictme" id="subdistrictme">
                                    @error('subdistrict_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="city_id">{{ __('City') }}</label>
                                    <select id="city_id" class="city-select form-control @error('city_id') is-invalid @enderror" required name="city_id">
                                      <option value="">Select City</option>
                                    </select>
                                    <input type="hidden" value="{{ old('city_id') }}" name="cityme" id="cityme">
                                    @error('city_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">{{ __('Pincode') }}</label>
                                    <input id="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}" required>
                                    @error('pincode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          </div>
                        </div>

                        @if(!$symptoms->isEmpty())
                          @foreach($symptoms as $symptom)
                            
                          @endforeach
                        @endif
                        <div class="form-group">
                            <label for="content">{{ __('Message') }}</label>
                            <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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
