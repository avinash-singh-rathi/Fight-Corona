<?php

namespace App\Http\Controllers;

use App\Model\Precaution;
use Illuminate\Http\Request;

class PrecautionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $precautions = Precaution::paginate(15);
        return view('precautions.index', ['precautions' => $precautions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('precautions.create');
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
            'name'=>'required|unique:symptoms',
            'content'=>'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images/precautions'), $imageName);
        $path='images/precautions/'.$imageName;

        $precaution = new Precaution([
            'name' => $request->get('name'),
            'content' => $request->get('content'),
            'image' => $path
        ]);
        $precaution->save();
        return redirect('/precautions')->with('success', 'Precaution created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Precaution  $precaution
     * @return \Illuminate\Http\Response
     */
    public function show(Precaution $precaution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Precaution  $precaution
     * @return \Illuminate\Http\Response
     */
    public function edit(Precaution $precaution)
    {
        //
        return view('precautions.edit',compact('precaution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Precaution  $precaution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Precaution $precaution)
    {
        //
        $request->validate([
            'name'=>'required|unique:symptoms,name,'.$precaution->id,
            'content'=>'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);
        if($request->image){
              $imageName = time().'.'.$request->image->extension();
              $request->image->move(public_path('images/precautions'), $imageName);
              $path='images/precautions/'.$imageName;
              $precaution->name = $request->get('name');
              $precaution->content = $request->get('content');
              $precaution->image = $path;
        }else{
            $precaution->name = $request->get('name');
            $precaution->content = $request->get('content');
        }
        $precaution->save();
        return redirect()->back()->with('success', 'Precaution updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Precaution  $precaution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Precaution $precaution)
    {
        //
        $precaution->delete();
        return redirect('/precautions')->with('success', 'Precaution deleted successfully!');
    }
}
