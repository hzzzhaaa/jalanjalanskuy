<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventFeedback extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'feedback',
    ];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
