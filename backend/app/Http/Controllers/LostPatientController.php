<?php

namespace App\Http\Controllers;

use App\Model\Lostpatient;
use Illuminate\Http\Request;

class LostPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lostpatients = Lostpatient::paginate(15);
        return view('lostpatients.index', ['lostpatients' => $lostpatients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lostpatients.create');
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
            'message'=>'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images/lostpatients'), $imageName);
        $path='images/lostpatients/'.$imageName;

        $lostpatient = new Lostpatient([
            'name' => $request->get('name'),
            'message' => $request->get('message'),
            'image' => $path
        ]);
        $lostpatient->save();
        return redirect('/lostpatients')->with('success', 'Lost Patient created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Lostpatient  $lostpatient
     * @return \Illuminate\Http\Response
     */
    public function show(Lostpatient $lostpatient)
    {
        //
        return view('lostpatients.show', ['lostpatient' => $lostpatient]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Lostpatient  $lostpatient
     * @return \Illuminate\Http\Response
     */
    public function edit(Lostpatient $lostpatient)
    {
        //
        return view('lostpatients.edit',compact('lostpatient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Lostpatient  $lostpatient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lostpatient $lostpatient)
    {
        //
        $request->validate([
            'name'=>'required',
            'message'=>'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);
        if($request->image){
              $imageName = time().'.'.$request->image->extension();
              $request->image->move(public_path('images/lostpatients'), $imageName);
              $path='images/lostpatients/'.$imageName;
              $lostpatient->image = $path;
        }
        $lostpatient->name = $request->get('name');
        $lostpatient->message = $request->get('message');
        $lostpatient->save();
        return redirect()->back()->with('success', 'Lost Patient updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Lostpatient  $lostpatient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lostpatient $lostpatient)
    {
        //
        $lostpatient->delete();
        return redirect('/lostpatients')->with('success', 'Lost Patient deleted successfully!');
    }
}
