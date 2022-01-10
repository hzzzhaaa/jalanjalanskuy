<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
     protected $fillable = [
        'bank','bankAccountName','bankAccountNumber', 'event_id'
    ];

        public function event() {
        return $this->belongsTo('App\Event');
    }
}
