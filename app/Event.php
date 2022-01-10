<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;

class Event extends Model
{
    use Hashidable;


    //TES WEBHOOK
    protected $fillable = [
        'name', 'location', 'image', 'date', 'description', 'timeStart', 'timeEnd', 'organizer_id', 'feature_id', 'approved', 'publish'
    ];

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function organizer()
    {
        return $this->belongsTo('App\Organizer');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\EventFeedback');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function paymentMethods()
    {
        return $this->hasMany('App\PaymentMethod');
    }

    public function divisions()
    {
        return $this->hasMany('App\Division');
    }
}
