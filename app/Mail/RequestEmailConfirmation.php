<?php

namespace App\Mail;

use App\Models\ContactChannelVerificationCode;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestEmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public ContactChannelVerificationCode $channelVerificationCode;
    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, ContactChannelVerificationCode $channelVerificationCode)
    {
        $this->channelVerificationCode = $channelVerificationCode;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.requestEmailConfirmation');

    }
}
