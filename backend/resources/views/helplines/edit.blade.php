@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Helpline <span class="float-right"><a href="{{route('helplines.index')}}">Back</a></span></div>
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
                    <form method="POST" action="{{ route('helplines.update',$helpline->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$helpline->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact">{{ __('Contact Information') }}</label>
                            <input type="number" id="contact" class="form-control @error('contact') is-invalid @enderror" name="contact" required value="{{ old('contact',$helpline->contact) }}">
                                @error('contact')
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
                                  <option value="{{$country->id}}" @if(old('country_id') == $country->id || $helpline->country_id == $country->id) selected @endif>{{$country->name}}</option>
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
                                <select id="state_id" class="state-select form-control @error('state_id') is-invalid @enderror" name="state_id">
                                  <option value="">Select State</option>
                                </select>
                                <input type="hidden" value="{{ old('state_id',$helpline->state_id) }}" name="stateme" id="stateme">
                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="district_id">{{ __('District') }}</label>
                                <select @change="getSubDistricts()" id="district_id" class="district-select form-control @error('district_id') is-invalid @enderror" name="district_id">
                                  <option value="">Select District</option>
                                </select>
                                <input type="hidden" value="{{ old('district_id',$helpline->district_id) }}" name="districtme" id="districtme">
                                @error('district_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="subdistrict_id">{{ __('Sub District') }}</label>
                                <select onchange="getCities()" id="subdistrict_id" class="subdistrict-select form-control @error('subdistrict_id') is-invalid @enderror" required name="subdistrict_id">
                                  <option value="">Select Sub District</option>
                                </select>
                                <input type="hidden" value="{{ old('subdistrict_id',$helpline->subdistrict_id) }}" name="subdistrictme" id="subdistrictme">
                                @error('subdistrict_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="city_id">{{ __('City') }}</label>
                                <select id="city_id" class="city-select form-control @error('city_id') is-invalid @enderror" name="city_id">
                                  <option value="">Select City</option>
                                </select>
                                <input type="hidden" value="{{ old('city_id',$helpline->city_id) }}" name="cityme" id="cityme">
                                @error('city_id')
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
