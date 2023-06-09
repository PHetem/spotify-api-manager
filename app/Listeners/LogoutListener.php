<?php

namespace App\Listeners;

use App\Http\Controllers\LogController;

class LogoutListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        LogController::store('Logout');
    }
}
