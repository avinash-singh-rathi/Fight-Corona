<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\{Symptom, Lostpatient, Patient, Post};

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->get('search')){
            $patients=Patient::where('user_id',auth()->user()->id)->where('name','like','%'.$request->get('search').'%')->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $patients=Patient::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        }
        return response()->json($patients,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|unique:suppliers,name,null,null,city_id,'.$request->get('city_id'),
            'pincode'=>'required',
            'age'=>'required|numeric',
            'address'=>'required',
            'symptoms'=>'required|json',
            'message'=>'required',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'district_id' => 'required|exists:districts,id',
            'lostpatient_id' =>'nullable|exists:lostpatients,id'
        ]);

        $patient = new Patient([
            'name' => $request->get('name'),
            'pincode' => $request->get('pincode'),
            'age' => $request->get('age'),
            'address' => $request->get('address'),
            'symptoms' => $request->get('symptoms'),
            'message' => $request->get('message'),
            'country_id' => $request->get('country_id'),
            'state_id' => $request->get('state_id'),
            'district_id' => $request->get('district_id'),
            'city_id' => $request->get('city_id'),
            'user_id' => auth('api')->user()->id
        ]);

        if($request->get('longitude')){
            $patient->longitude = $request->get('longitude');
        }

        if($request->get('latitude')){
            $patient->latitude = $request->get('latitude');
        }

        if($request->get('lostpatient_id')){
            $patient->lostpatient_id = $request->get('lostpatient_id');
        }

        $patient->save();
        return response()->json(['message' => 'Patient reported successfully!'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function symptoms(){
        $symptoms=Symptom::all();
        return response()->json($symptoms,200);
    }

    public function lostpatients(Request $request)
    {
        //
        if($request->get('search')){
          $lostpatients=Lostpatient::where('name','like','%'.$request->get('search').'%')->orderBy('created_at', 'desc')->paginate(10);
        }else{
          $lostpatients=Lostpatient::orderBy('created_at', 'desc')->paginate(10);
        }
        return response()->json($lostpatients,200);
    }

}
