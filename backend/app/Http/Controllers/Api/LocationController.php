<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\{Country, State, District, Subdistrict, City, Supplier};

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function countries(){
      $countries=Country::all();
      return response()->json($countries,200);
    }

    public function states($id){
      $states=State::where('country_id',$id)->get();
      return response()->json($states,200);
    }

    public function districts($id){
      $districts=District::where('state_id',$id)->get();
      return response()->json($districts,200);
    }

    public function subdistricts($id){
      $subdistricts=Subdistrict::where('district_id',$id)->get();
      return response()->json($subdistricts,200);
    }

    public function cities($id){
      $cities=City::where('subdistrict_id',$id)->get();
      return response()->json($cities,200);
    }

    public function CitySuppliers($id){
      $suppliers=Supplier::where('city_id',$id)->get();
      return response()->json($suppliers,200);
    }
}
