<?php

namespace App\Http\Controllers;

use App\Model\{Country, State, District};
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $districts = District::paginate(15);
        return view('districts.index', ['districts' => $districts]);
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
        return view('districts.create',['countries' => $countries]);
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
            'name'=>'required|unique:districts,name,null,null,state_id,'.$request->get('state_id'),
            'state_id' => 'required|exists:states,id'
        ]);

        $district = new District([
            'name' => $request->get('name'),
            'state_id' => $request->get('state_id')
        ]);
        $district->save();
        return redirect('/districts')->with('success', 'District created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
        $countries = Country::all();
        return view('districts.edit',['countries' => $countries,'district' => $district]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        //
        $request->validate([
            'name'=>'required|unique:districts,name,'.$district->id.',id,state_id,'.$request->get('state_id'),
            'state_id' => 'required|exists:states,id'
        ]);
            $district->name = $request->get('name');
            $district->state_id = $request->get('state_id');

            $district->save();
        return redirect()->back()->with('success', 'District updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        //
        $district->delete();
        return redirect('/districts')->with('success', 'District deleted successfully!');
    }

    /*
    Get the disticts by the state id and return json
    */
    public function getDistrictsByState(Request $request){
      $districts=District::where('state_id',$request->get('state_id'))->get();
      return response()->json(['data'=>$districts],200);
    }

}
