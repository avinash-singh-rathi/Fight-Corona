<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $fillable = [
        'name', 'district_id', 'pincode'
    ];

    public function district()
    {
        return $this->belongsTo('App\Model\District');
    }
}
