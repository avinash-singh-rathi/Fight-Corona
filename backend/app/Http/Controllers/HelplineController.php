<?php

namespace App\Http\Controllers;

use App\Model\{Country, Helpline};
use Illuminate\Http\Request;

class HelplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $helplines = Helpline::paginate(15);
        return view('helplines.index', ['helplines' => $helplines]);
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
        return view('helplines.create',['countries' => $countries]);
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
            'name'=>'required',
            'contact'=>'required',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'district_id' => 'nullable|exists:districts,id',
            'subdistrict_id' => 'nullable|exists:subdistricts,id',
            'city_id' => 'nullable|exists:cities,id',
        ]);

        $helpline = new Helpline([
            'name' => $request->get('name'),
            'contact' => $request->get('contact'),
            'country_id' => $request->get('country_id'),
            'state_id' => $request->get('state_id'),
            'district_id' => $request->get('district_id'),
            'subdistrict_id' => $request->get('subdistrict_id'),
            'city_id' => $request->get('city_id')
        ]);

        $helpline->save();
        return redirect('/helplines')->with('success', 'Helpline created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Helpline  $helpline
     * @return \Illuminate\Http\Response
     */
    public function show(Helpline $helpline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Helpline  $helpline
     * @return \Illuminate\Http\Response
     */
    public function edit(Helpline $helpline)
    {
        //
        $countries = Country::all();
        return view('helplines.edit',['countries' => $countries,'helpline' => $helpline]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Helpline  $helpline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Helpline $helpline)
    {
        //
        $request->validate([
            'name'=>'required',
            'contact'=>'required',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'district_id' => 'nullable|exists:districts,id',
            'subdistrict_id' => 'nullable|exists:subdistricts,id',
            'city_id' => 'nullable|exists:cities,id'
        ]);
            $helpline->name = $request->get('name');
            $helpline->contact = $request->get('contact');
            $helpline->country_id = $request->get('country_id');
            $helpline->state_id = $request->get('state_id');
            $helpline->district_id = $request->get('district_id');
            $helpline->subdistrict_id = $request->get('subdistrict_id');
            $helpline->city_id = $request->get('city_id');
            $helpline->save();
        return redirect()->back()->with('success', 'Helpline updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Helpline  $helpline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Helpline $helpline)
    {
        //
        $supplier->delete();
        return redirect('/suppliers')->with('success', 'Supplier deleted successfully!');
    }
}
