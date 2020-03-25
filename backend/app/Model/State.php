<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $fillable = [
        'name', 'country_id'
    ];

    public function country()
    {
        return $this->belongsTo('App\Model\Country');
    }

    public function districts()
    {
         return $this->hasMany('App\Model\District');
    }
}
