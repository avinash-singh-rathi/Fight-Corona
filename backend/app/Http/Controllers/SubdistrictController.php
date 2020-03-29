<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{Country, State, District, Subdistrict};

class SubdistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subdistricts = Subdistrict::paginate(15);
        return view('subdistricts.index', ['subdistricts' => $subdistricts]);
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
        return view('subdistricts.create',['countries' => $countries]);
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
            'name'=>'required|unique:subdistricts,name,null,null,district_id,'.$request->get('district_id'),
            'pincode'=>'required',
            'district_id' => 'required|exists:districts,id'
        ]);

        $subdistrict = new Subdistrict([
            'name' => $request->get('name'),
            'pincode' => $request->get('pincode'),
            'district_id' => $request->get('district_id')
        ]);
        $subdistrict->save();
        return redirect('/subdistricts')->with('success', 'Sub District created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Subdistrict  $subdistrict
     * @return \Illuminate\Http\Response
     */
    public function show(Subdistrict $subdistrict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Subdistrict  $subdistrict
     * @return \Illuminate\Http\Response
     */
    public function edit(Subdistrict $subdistrict)
    {
        //
        $countries = Country::all();
        return view('subdistricts.edit',['countries' => $countries,'subdistrict' => $subdistrict]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Subdistrict  $subdistrict
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subdistrict $subdistrict)
    {
        //
        $request->validate([
            'name'=>'required|unique:subdistricts,name,'.$subdistrict->id.',id,district_id,'.$request->get('district_id'),
            'pincode'=>'required',
            'district_id' => 'required|exists:districts,id'
        ]);
            $subdistrict->name = $request->get('name');
            $subdistrict->pincode = $request->get('pincode');
            $subdistrict->district_id = $request->get('district_id');

            $subdistrict->save();
        return redirect()->back()->with('success', 'Sub District updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Subdistrict  $subdistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subdistrict $subdistrict)
    {
        //
        $subdistrict->delete();
        return redirect('/subdistricts')->with('success', 'Sub District deleted successfully!');
    }

    public function getSubdistrictByDistrict(Request $request){
      $subdistricts=Subdistrict::where('district_id',$request->get('district_id'))->get();
      return response()->json(['data'=>$subdistricts],200);
    }

}
