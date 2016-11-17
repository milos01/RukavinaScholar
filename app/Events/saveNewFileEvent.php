<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Http\Request;

class saveNewFileEvent extends Event
{
    use SerializesModels;
    public $req;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->req = $request;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    // public function broadcastOn()
    // {
    //     return [];
    // }
}
