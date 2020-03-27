<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    //

    protected $fillable = [
        'name', 'content', 'image'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(){
        if($this->image){
          return url($this->image);
        }
        return NULL;
    }
}
