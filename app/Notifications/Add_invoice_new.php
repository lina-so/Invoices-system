<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;



class Add_invoice_new extends Notification
{
    use Queueable;

    private $invoices_last_add;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(invoices $invoices_last_add)
    {
        $this->invoices_last_add=$invoices_last_add;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
  

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            // 'data'=>$this->details['body']
            'id'=>$this->invoices_last_add->id,
            'title'=>'تم إضافة فاتورة جديدة بواسطة :',
            'user'=>Auth::user()->name,
        ];
    }
}
