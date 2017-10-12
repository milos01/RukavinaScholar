<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SaveFileEvent extends Event
{
    use SerializesModels;

    public $pathName;
    public $fileName;
    public $file;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($pathName, $fileName, $file)
    {
        $this->pathName = $pathName;
        $this->fileName = $fileName;
        $this->file = $file;
    }
}
