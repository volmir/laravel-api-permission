<?php

namespace App\Listeners;

use App\Events\UserRoleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class UserRoleCreatedNotification
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
    public function handle(UserRoleCreated $event): void
    {
        $message = 'Add new role: [' . $event->userRole->user_id . ', ' . $event->userRole->role_id . ']';
        Storage::disk('local')->append('logs/user_roles.txt', $message);
    }
}
