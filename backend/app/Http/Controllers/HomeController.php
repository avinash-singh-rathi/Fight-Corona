<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Model\{State, District, Subdistrict, City};



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['test']);
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
      ini_set('max_execution_time', '0');
      $files=[];
      $files[]='public/country3.json';
      //$files[]='public/country4.json';
      //$files[]='public/country5.json';
      //$files[]='public/country6.json';
      echo "Data Import Process started<br>";
      foreach($files as $file){
          echo $file."<br>";
          $data=Storage::get($file);
          echo "<pre>";
          //print_r($data);	
	  //echo "Hello";die;
          $country_id=1;
	  $data=json_encode($data);
          $data=json_decode($data);
	  print_r($data);die;	          
	foreach($data as $d){
            print_r($d);die;	
	    $state=State::where('name',$d->statename)->where('country_id',$country_id)->first();
            if(!$state){
              echo "State: ".$d->statename."<br>";
              $state = new State();
              $state->name = $d->statename;
              $state->country_id = $country_id;
              $state->save();
            }

            $district=District::where('name',$d->DistrictName)->where('state_id',$state->id)->first();
            if(!$district){
              echo "District: ".$d->DistrictName."<br>";
              $district = new District();
              $district->name = $d->DistrictName;
              $district->state_id = $state->id;
              $district->save();
            }

            $subdistrict = Subdistrict::where('name',$d->SubDistrictName)->where('district_id',$district->id)->first();
            if(!$subdistrict){
                echo "Sub District: ".$d->SubDistrictName."<br>";
                $subdistrict = new Subdistrict();
                $subdistrict->name = $d->SubDistrictName;
                $subdistrict->district_id = $district->id;
                $subdistrict->save();
            }

            $city= new City();
            $city->name = $d->VillageName;
            $city->subdistrict_id = $subdistrict->id;
            $city->save();
            //print_r($d);
          }
        }
        echo "Import Process Finished";

    }

    public function test1(){
      ini_set('max_execution_time', '0');
      $data=Storage::get('public/states.json');
      $data=json_decode($data);
      $state_id=13;
      $state=State::find($state_id);
      echo "State: ".$state->name."<br>";
      $district_id=207;
      $district=District::find($district_id);
      echo "District: ".$district->name."<br>";
      echo "<pre>";
      //die;
      //print_r($data);

      foreach($data as $d){
        $subdistrict = Subdistrict::where('name',$d->SubDistrictName)->where('district_id',$district_id)->first();
        if(!$subdistrict){
            echo "Sub District: ".$d->SubDistrictName."<br>";
            $subdistrict = new Subdistrict();
            $subdistrict->name = $d->SubDistrictName;
            $subdistrict->district_id = $district_id;
            $subdistrict->save();
        }

        $city= new City();
        $city->name = $d->VillageName;
        $city->subdistrict_id = $subdistrict->id;
        $city->save();
        print_r($d);
      }
    }

}
