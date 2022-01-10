<?php

namespace App;

use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use Hashidable;

    protected $fillable = [
        'name','price','limit','onsale', 'event_id'
    ];

    public function users() {
        return $this->belongsToMany('App\User')->withPivot('approved','receipt','checkin','id','feedback','rating','created_at')->withTimestamps();
    }

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function getTicketStatus()
    {
        if($this->pivot->checkin == 1) {
            return 4;
        }
        elseif($this->pivot->approved == 1) {
            return 3;
        }elseif($this->pivot->receipt !=null) {
            return 2;
        }elseif($this->pivot->receipt == null) {
            return 1;
        }
        // if($this->pivot->receipt == null && $this->pivot->approved != 1) {
        //     return 1;   //NOTE: 1 itu dia belom ngasih bukti
        // }elseif($this->pivot->approved != 1) {
        //     return 2;   //NOTE: 2 itu dia udah ngasih bukti tapi belom di approve
        // }elseif($this->pivot->approved == 1) {
        //     return 3;   //NOTE: 3 itu berarti tiket udah approved fix
        // }
    }
}
