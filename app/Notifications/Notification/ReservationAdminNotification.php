<?php

namespace App\Notifications\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationAdminNotification extends Notification
{
    use Queueable;
    public $id;
    private $name;
    private $email;
    private $phone;
    private $date;
    private $time;
    private $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->id = $data->reservation_id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->date = $data->date;
        $this->time = $data->time;
        $this->type = $data->type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->line($this->name .', Send a reservation request.')
            ->line('Reservation ID: '.$this->id)
            ->line('Email: '.$this->email)
            ->line('Phone: '.$this->phone)
            ->line('Date: '.$this->date)
            ->line('Time: '.$this->time)
            ->action('Accept/Reject', url('/admin-login'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
