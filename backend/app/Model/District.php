<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $fillable = [
        'name', 'state_id'
    ];

    public function state()
    {
        return $this->belongsTo('App\Model\State');
    }

    public function cities()
    {
         return $this->hasMany('App\Model\City');
    }

}
