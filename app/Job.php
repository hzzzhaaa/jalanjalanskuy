<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name','status','overdue', 'deadline_id',
    ];

    public function deadline()
    {
        return $this->belongsTo('App\Deadline');
    }
}
