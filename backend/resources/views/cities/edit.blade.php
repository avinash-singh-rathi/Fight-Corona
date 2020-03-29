@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit City <span class="float-right"><a href="{{route('cities.index')}}">Back</a></span></div>
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
                    <form method="POST" action="{{ route('cities.update',$city->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$city->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="pincode">{{ __('Pincode') }}</label>
                                <input id="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode',$city->pincode) }}" required>
                                @error('pincode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="country_id">{{ __('Country') }}</label>
                                <select id="country_id" class="form-control @error('country_id') is-invalid @enderror" required name="country_id">
                                  <option value="">Select Country</option>
                                  @foreach($countries as $country)
                                  <option value="{{$country->id}}" @if(old('country_id') == $country->id || $city->subdistrict->district->state->country_id == $country->id) selected @endif>{{$country->name}}</option>
                                  @endforeach
                                </select>
                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="state_id">{{ __('State') }}</label>
                                <select id="state_id" class="state-select form-control @error('state_id') is-invalid @enderror" required name="state_id">
                                  <option value="">Select State</option>
                                </select>
                                <input type="hidden" value="{{ old('state_id',$city->subdistrict->district->state_id) }}" name="stateme" id="stateme">
                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="district_id">{{ __('District') }}</label>
                                <select @change="getSubDistricts()" id="district_id" class="district-select form-control @error('district_id') is-invalid @enderror" required name="district_id">
                                  <option value="">Select District</option>
                                </select>
                                <input type="hidden" value="{{ old('district_id',$city->subdistrict->district_id) }}" name="districtme" id="districtme">
                                @error('district_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="subdistrict_id">{{ __('Sub District') }}</label>
                                <select id="subdistrict_id" class="subdistrict-select form-control @error('subdistrict_id') is-invalid @enderror" required name="subdistrict_id">
                                  <option value="">Select Sub District</option>
                                </select>
                                <input type="hidden" value="{{ old('subdistrict_id',$city->subdistrict_id) }}" name="subdistrictme" id="subdistrictme">
                                @error('district_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
