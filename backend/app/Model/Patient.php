<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
        'name', 'age', 'address', 'country_id','state_id','district_id','city_id', 'city', 'pincode', 'symptoms', 'message',
         'longitude', 'latitude', 'lostpatient_id', 'user_id', 'is_read', 'is_solved', 'remarks'
    ];


}
