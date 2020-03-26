<?php

namespace App\Http\Controllers;

use App\Model\{Country, State, District, City, Supplier};
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Supplier::paginate(15);
        return view('suppliers.index', ['suppliers' => $suppliers]);
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
        return view('suppliers.create',['countries' => $countries]);
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
            'name'=>'required|unique:suppliers,name,null,null,city_id,'.$request->get('city_id'),
            'pincode'=>'required',
            'address'=>'required',
            'packageinfo'=>'required',
            'contact'=>'required',
            'city_id' => 'required|exists:cities,id',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);

        $supplier = new Supplier([
            'name' => $request->get('name'),
            'pincode' => $request->get('pincode'),
            'address' => $request->get('address'),
            'deliveryarea' => $request->get('deliveryarea'),
            'packageinfo' => $request->get('packageinfo'),
            'contact' => $request->get('contact'),
            'city_id' => $request->get('city_id')
        ]);

        if($request->hasFile('image')){
          $imageName = time().'.'.$request->image->extension();
          $request->image->move(public_path('images/suppliers'), $imageName);
          $path='images/suppliers/'.$imageName;
          $supplier->image = $path;
        }
        $supplier->save();
        return redirect('/suppliers')->with('success', 'Supplier created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
        $countries = Country::all();
        return view('suppliers.edit',['countries' => $countries,'supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
        $request->validate([
            'name'=>'required|unique:suppliers,name,'.$supplier->id.',id,city_id,'.$request->get('city_id'),
            'pincode'=>'required',
            'address'=>'required',
            'packageinfo'=>'required',
            'contact'=>'required',
            'city_id' => 'required|exists:cities,id',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);
            $supplier->name = $request->get('name');
            $supplier->pincode = $request->get('pincode');
            $supplier->city_id = $request->get('city_id');
            $supplier->address = $request->get('address');
            $supplier->deliveryarea = $request->get('deliveryarea');
            $supplier->packageinfo = $request->get('packageinfo');
            $supplier->contact = $request->get('contact');

            if($request->hasFile('image')){
              $imageName = time().'.'.$request->image->extension();
              $request->image->move(public_path('images/suppliers'), $imageName);
              $path='images/suppliers/'.$imageName;
              $supplier->image = $path;
            }
            $supplier->save();
        return redirect()->back()->with('success', 'Supplier updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
        $supplier->delete();
        return redirect('/suppliers')->with('success', 'Supplier deleted successfully!');
    }
}
