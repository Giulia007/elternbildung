<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user_id    =  $event->user->id;
        $user_agent =  \Illuminate\Support\Facades\Request::header('User-Agent');
        $ip_address =  \Illuminate\Support\Facades\Request::ip();

        Log::useFiles(base_path() . '/storage/logs/login_info.log', 'info');
        Log::info('user_id: ' . $user_id .', '.
                'user_agent: ' . $user_agent .', '.
                'ip_address: ' . $ip_address
            );

    }
}
