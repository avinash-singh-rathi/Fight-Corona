<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Helpline extends Model
{
    //
    protected $fillable = [
        'name', 'city_id', 'country_id', 'state_id', 'district_id', 'contact'
    ];

    public function country()
    {
        return $this->belongsTo('App\Model\Country');
    }
    public function state()
    {
        return $this->belongsTo('App\Model\State');
    }
    public function district()
    {
        return $this->belongsTo('App\Model\District');
    }

    public function city()
    {
        return $this->belongsTo('App\Model\City');
    }
}
