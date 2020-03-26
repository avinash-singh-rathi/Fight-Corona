<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lostpatient extends Model
{
    //
    protected $fillable = [
        'name', 'message', 'image'
    ];
}
