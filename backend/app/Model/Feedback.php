<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table = 'feedbacks';

    protected $fillable = [
        'subject', 'message', 'user_id', 'is_read'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
