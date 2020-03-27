<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lostpatient extends Model
{
    //
    protected $fillable = [
        'name', 'message', 'image'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(){
        if($this->image){
          return url($this->image);
        }
        return NULL;
    }
}
