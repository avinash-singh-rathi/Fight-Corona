<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\{Post, Precaution, Helpline, Feedback};

class GeneralController extends Controller
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

    /*
    Get the news along with search
    */
    public function posts(Request $request)
    {
        //
        if($request->get('search')){
          $news=Post::where('name','like','%'.$request->get('search').'%')->orderBy('created_at', 'desc')->paginate(10);
        }else{
          $news=Post::orderBy('created_at', 'desc')->paginate(10);
        }
        return response()->json($news,200);
    }

    /*
    Get All the precautions
    */
    public function precautions(){
      $precautions=Precaution::all();
      return response()->json($precautions,200);
    }

    /*
    Get All the Helpline according to Country, State, District, City
    */
    public function helplines(Request $request){
        if($request->get('city')){
          //
          $helplines=Helpline::where('city_id',$request->get('city'))->get();
          return response()->json($helplines,200);
        }
        if($request->get('district')){
          //
          $helplines=Helpline::where('district_id',$request->get('district'))->whereNull('city_id')->get();
          return response()->json($helplines,200);
        }
        if($request->get('state')){
          //
          $helplines=Helpline::where('state_id',$request->get('state'))->whereNull('district_id')->whereNull('city_id')->get();
          return response()->json($helplines,200);
        }
        if($request->get('country')){
          //
          $helplines=Helpline::where('country_id',$request->get('country'))->whereNull('state_id')->whereNull('district_id')->whereNull('city_id')->get();
          return response()->json($helplines,200);
        }
    }

    /*
    Create Feedback
    */
    public function CreateFeedback(Request $request){
      $request->validate([
          'subject'=>'required',
          'message'=>'required'
      ]);

      $feedback = new Feedback([
          'subject' => $request->get('subject'),
          'message' => $request->get('message'),
          'user_id' => auth('api')->user()->id
      ]);

      $feedback->save();
      return response()->json(['message' => 'Thanks for sharing your feedback!'],200);
    }

}
