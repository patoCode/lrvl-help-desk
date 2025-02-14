<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AsignarRoles
{
    use Dispatchable, SerializesModels;

    public User $user;
    public array $rols;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, array $rols)
    {
        $this->rols = $rols;
        $this->user = $user;
    }

}
