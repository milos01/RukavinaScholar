<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class makeProfilePictureEvent extends Event
{
    use SerializesModels;

    public $email;
    public $name;
    public $last_name;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $name, $last_name)
    {
        $this->email = $email;
        $this->name = $name;
        $this->last_name = $last_name;
    }
}
