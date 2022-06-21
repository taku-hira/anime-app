<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BroadcastNotficationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $title, $on_air_data, $on_air_info)
    {
        $this->name = $name;
        $this->email = $email;
        $this->title = $title;
        $this->on_air_date = $on_air_data;
        $this->on_air_info = $on_air_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
            ->subject($this->title . '放送通知')
            ->view('emails.notification')
            ->with([
                'name' => $this->name,
                'title' => $this->title,
                'on_air_date' => $this->on_air_date,
                'on_air_info' => $this->on_air_info,
            ]);
    }
}
