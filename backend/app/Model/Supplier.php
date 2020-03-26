<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
        'name', 'city_id', 'pincode', 'address', 'deliveryarea', 'packageinfo', 'contact', 'image'
    ];

    public function city()
    {
        return $this->belongsTo('App\Model\City');
    }
}
