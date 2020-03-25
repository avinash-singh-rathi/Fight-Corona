<?php

namespace App\Http\Controllers;

use App\Model\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $symptoms = Symptom::paginate(15);
        return view('symptoms.index', ['symptoms' => $symptoms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('symptoms.create');
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
            'name'=>'required|unique:symptoms',
            'content'=>'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images/symptoms'), $imageName);
        $path='images/symptoms/'.$imageName;

        $symptom = new Symptom([
            'name' => $request->get('name'),
            'content' => $request->get('content'),
            'image' => $path
        ]);
        $symptom->save();
        return redirect('/symptoms')->with('success', 'Symptom created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function edit(Symptom $symptom)
    {
        return view('symptoms.edit',compact('symptom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symptom $symptom)
    {
        //
        $request->validate([
            'name'=>'required|unique:symptoms,name,'.$symptom->id,
            'content'=>'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);
        if($request->image){
              $imageName = time().'.'.$request->image->extension();
              $request->image->move(public_path('images/symptoms'), $imageName);
              $path='images/symptoms/'.$imageName;
              $symptom->name = $request->get('name');
              $symptom->content = $request->get('content');
              $symptom->image = $path;
        }else{
            $symptom->name = $request->get('name');
            $symptom->content = $request->get('content');
        }
        $symptom->save();
        return redirect()->back()->with('success', 'Symptom updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symptom $symptom)
    {
        //
        $symptom->delete();
        return redirect('/symptoms')->with('success', 'Symptom deleted successfully!');
    }
}
