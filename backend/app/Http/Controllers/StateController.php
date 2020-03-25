<?php

namespace App\Http\Controllers;

use App\Model\{State,Country};
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $states = State::paginate(15);
        return view('states.index', ['states' => $states]);
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
        return view('states.create',['countries' => $countries]);
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
            'name'=>'required|unique:states,name,null,null,country_id,'.$request->get('country_id'),
            'country_id' => 'required|exists:countries,id'
        ]);

        $state = new State([
            'name' => $request->get('name'),
            'country_id' => $request->get('country_id')
        ]);
        $state->save();
        return redirect('/states')->with('success', 'State created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
        $countries = Country::all();
        return view('states.edit',['countries' => $countries,'state' => $state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        //
        $request->validate([
            'name'=>'required|unique:states,name,'.$state->id.',id,country_id,'.$request->get('country_id'),
            'country_id' => 'required|exists:countries,id'
        ]);
            $state->name = $request->get('name');
            $state->country_id = $request->get('country_id');

            $state->save();
        return redirect()->back()->with('success', 'State updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //
        $state->delete();
        return redirect('/states')->with('success', 'State deleted successfully!');
    }

    /*
    Get all the states by the country id and return json
    */
    public function getStatesByCountry(Request $request){
      $states=State::where('country_id',$request->get('country_id'))->get();
      return response()->json(['data'=>$states],200);
    }

}
