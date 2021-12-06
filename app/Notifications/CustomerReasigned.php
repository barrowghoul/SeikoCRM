<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerReasigned extends Notification
{
    use Queueable;
    public $manager_id;
    public $vendor_id;
    public $customer_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($manager_id, $vendor_id, $customer_id)
    {
        $this->manager_id = $manager_id;
        $this->vendor_id = $vendor_id;
        $this->customer_id = $customer_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->view('emails.prospect.reasign',['customer_id' => $this->customer_id]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'url' => route('prospects.edit', $this->customer_id),
            'message' => User::find($this->manager_id)->name . ' le ha reasignado un prospecto.'
        ];
    }
}
