<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceOverdue extends Notification
{
    use Queueable;

    protected $invoices;
    protected $client;

    public function __construct($entries, $client)
    {
       $this->invoices = $entries;

        $this->client = $client;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->from('finianceiro@inovedados.com.br', 'INOVE DADOS')
            ->view( 'emails.invoice_overdue', ['invoices' => $this->invoices, 'client'=> $this->client]);
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}
