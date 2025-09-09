<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendNotificationVerificationRegistrasi extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $pesan,$status;
    public function __construct($status)
    {
        $this->status = $status;
        $this->pesan = ($status == 'tolak') 
        ? 'Mohon maaf, verifikasi akun anda ditolak oleh administrator kami.Silahkan register kembali dengan data yang valid'
        : 'Selamat, verifikasi akun anda di terima oleh administrator kami.Silahkan lanjutkan mengisi data diri anda';
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
            ->subject('Verifikasi akun di'.$this->status)
            ->greeting('Salam Sehat!')
            ->line($this->pesan)
            ->line("Terimakasih atas kesabaran dan kerjasamanya.");
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
