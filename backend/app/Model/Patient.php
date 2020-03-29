<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
        'name', 'age', 'address', 'country_id','state_id','district_id', 'subdistrict_id', 'city_id', 'cityname', 'pincode', 'symptoms', 'message',
         'longitude', 'latitude', 'lostpatient_id', 'user_id', 'is_read', 'is_solved', 'remarks'
    ];

    public function city()
    {
        return $this->belongsTo('App\Model\City');
    }

    public function subdistrict()
    {
        return $this->belongsTo('App\Model\Subdistrict');
    }

    public function district()
    {
        return $this->belongsTo('App\Model\District');
    }

    public function state()
    {
        return $this->belongsTo('App\Model\State');
    }

    public function country()
    {
        return $this->belongsTo('App\Model\Country');
    }

    public function getSymptomsallAttribute()
    {
        return json_decode($this->symptoms);
    }
    

}
