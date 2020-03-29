<?php

namespace App\Http\Controllers;

use App\Model\{Country, State, District, City};
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::paginate(15);
        return view('cities.index', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = Country::all();
        return view('cities.create',['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required|unique:cities,name,null,null,subdistrict_id,'.$request->get('subdistrict_id'),
            'pincode'=>'required',
            'subdistrict_id' => 'required|exists:subdistricts,id'
        ]);

        $city = new City([
            'name' => $request->get('name'),
            'pincode' => $request->get('pincode'),
            'subdistrict_id' => $request->get('subdistrict_id')
        ]);
        $city->save();
        return redirect('/cities')->with('success', 'City created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
        $countries = Country::all();
        return view('cities.edit',['countries' => $countries,'city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
        $request->validate([
            'name'=>'required|unique:cities,name,'.$city->id.',id,subdistrict_id,'.$request->get('subdistrict_id'),
            'pincode'=>'required',
            'subdistrict_id' => 'required|exists:subdistricts,id'
        ]);
            $city->name = $request->get('name');
            $city->pincode = $request->get('pincode');
            $city->subdistrict_id = $request->get('subdistrict_id');

            $city->save();
        return redirect()->back()->with('success', 'City updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
        $city->delete();
        return redirect('/cities')->with('success', 'City deleted successfully!');
    }

    /*
    Get the cities by the district id and return json
    */
    public function getCitiesBySubdistrict(Request $request){
      $cities=City::where('subdistrict_id',$request->get('subdistrict_id'))->get();
      return response()->json(['data'=>$cities],200);
    }

}
