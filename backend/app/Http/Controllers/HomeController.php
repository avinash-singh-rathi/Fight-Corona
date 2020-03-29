<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Model\{State, District, City};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test(){
      $data=Storage::get('public/states.json');
      $data=json_decode($data);
      echo "<pre>";
      //print_r($data);

      foreach($data as $d){
        $city= new City();
        $city->name = $d->village;
        $city->district_id = 220;
        $city->save();
        print_r($d);
      }
    }
}
