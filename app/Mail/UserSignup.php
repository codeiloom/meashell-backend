<?php

namespace App\Mail;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Queue\SerializesModels;

class UserSignup extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user ;
        $this->activation_token = $user->activation_token;
        $this->date = Verta(Carbon::now())->format('H:i | Y-n-j');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.usersignup')->subject('ثبت نام در سامانه Mea')->with([
            'name' => $this->user->name,
            'activation_token' => $this->activation_token,
            'date' => $this->date
        ]);
    }
}
