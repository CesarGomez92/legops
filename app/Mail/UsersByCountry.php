<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsersByCountry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user_by_country = []; 
        $countries = User::groupBy('country')->pluck('country')->toArray();
        
        foreach ($countries as $country){
            $users_count = User::where('country', $country)->count();
            $user_by_country[] = ['country' => $country, 'users' => $users_count];
        }
        
        return $this->subject('Usuarios por pais')->markdown('emails.users.users_by_country', [
            'users_by_country' => $user_by_country,
        ]);
    }
}
