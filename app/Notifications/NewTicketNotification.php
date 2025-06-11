<?php
namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewTicketNotification extends Notification
{
    use Queueable;

    protected $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    return [
        'title' => 'Pesanan Tiket Baru',
        'message' => 'Pengguna ' . $this->ticket->user->name . ' memesan ' . $this->ticket->quantity . ' tiket.',
        'ticket_id' => $this->ticket->id,
        'user_name' => $this->ticket->user->name,
        'quantity' => $this->ticket->quantity,
        'total_price' => $this->ticket->total_price,
        'visitor_names' => is_string($this->ticket->names) ? json_decode($this->ticket->names, true) : $this->ticket->names,
    ];
}




}

