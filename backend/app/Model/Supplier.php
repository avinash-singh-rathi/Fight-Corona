<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
        'name', 'city_id', 'pincode', 'address', 'deliveryarea', 'packageinfo', 'contact', 'image'
    ];

    protected $appends = ['image_url'];

    public function city()
    {
        return $this->belongsTo('App\Model\City');
    }

    public function getImageUrlAttribute(){
        if($this->image){
          return url($this->image);
        }
        return NULL;
    }
}
