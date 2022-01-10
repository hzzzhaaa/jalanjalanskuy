<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class division extends Model
{
    protected $fillable = [
        'name','event_id',
    ];

    public function users() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function deadlines()
    {
        return $this->hasMany('App\Deadline');
    }
}
