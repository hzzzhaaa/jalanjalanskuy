<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    protected $fillable = [
        'date', 'division_id',
    ];

    public function division()
    {
        return $this->belongsTo('App\Division');
    }

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }
}
