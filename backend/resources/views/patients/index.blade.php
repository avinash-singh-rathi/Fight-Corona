@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Reported Patientss <span class="float-right"><a href="{{route('patients.create')}}">Create Reported Patient</a></span></div>
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
                  @if(!$patients->isEmpty())
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Patient</td>
                          <td>Age</td>
                          <td>County</td>
                          <td>State</td>
                          <td>District</td>
                          <td>Tehsil</td>
                          <td>City</td>
                          <td>Symptoms</td>
                          <td>Opened</td>
                          <td>Solved</td>
                          <td>Lost Patient</td>
                          <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td>{{$patient->id}}</td>
                            <td>{{$patient->name}}</td>
                            <td>{{$patient->age}}</td>
                            <td>{{$patient->country->name}}</td>
                            <td>{{$patient->state->name}}</td>
                            <td>{{$patient->district->name}}</td>
                            <td>{{$patient->subdistrict->name}}</td>
                            <td>{{$patient->city->name}}</td>
                            <td>
                              @if($patient->symptoms)
                                @foreach($patient->symptomsall as $symptom)
                                  @if($symptom->checked)
                                    {{$symptom->name}}
                                  @endif
                                @endforeach
                              @endif
                            </td>
                            <td>
                              @if($patient->is_read)
                                Yes
                              @else
                                No
                              @endif
                            </td>
                            <td>
                              @if($patient->is_solved)
                                Yes
                              @else
                                No
                              @endif
                            </td>
                            <td>
                              @if($patient->lostpatient_id)
                                <a href="{{route('lostpatients.show',$patient->lostpatient_id)}}">{{$patient->lostpatient_id}}</a>
                              @endif
                            </td>
                            <td>
                                <a href="{{ route('lostpatients.edit',$patient->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $patients->links() }}
                  @else

                  <div class="">
                    Not having any Reported Patient. Please create <a href="{{route('patients.create')}}">one</a>.
                  </div>

                  @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
