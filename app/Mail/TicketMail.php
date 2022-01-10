<?php

namespace App\Mail;

use App\Ticket;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Vinkla\Hashids\Facades\Hashids;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;


    public $ticket,$user,$ticketuser;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket,User $user,$ticketuser)
    {
        $this->ticket = $ticket;
        $this->user = $user;
        $this->ticketuser = $ticketuser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->subject('Your ticket for ' . $this->ticket->event->name)
                    ->view('mail.ticket')
                    ->attachData(QrCode::format('png')->size(250)->generate($this->ticketuser),'Ticket_'.$this->ticket->event->name . '_'. $this->user->name . '.png',
                ['mime'=> 'application/png']);
    }
}
