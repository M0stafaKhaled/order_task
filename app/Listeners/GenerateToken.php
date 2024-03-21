<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Services\TokenServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateToken
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $event->user->token = app(TokenServiceInterface::class)->createForUser($event->user);
    }

}
