<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;

class Organizer extends Model
{
    use Hashidable;

    protected $fillable = [
        'name', 'picture', 'description'
    ];

    public function members()
    {
        return $this->hasMany('App\User');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
