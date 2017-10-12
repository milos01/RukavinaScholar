<?php

namespace App\Listeners;

use App\Events\SaveFileEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

class SaveFileHandler
{
    private $i;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->i = 1;
    }

    /**
     * Handle the event.
     *
     * @param  saveFileEvent  $event
     * @return void
     */
    public function handle(SaveFileEvent $event)
    {   
        $newFileName = $event->fileName;
        while(Storage::disk($event->pathName)->exists($newFileName)){
            $newFileName = "(".$this->i.")".$event->fileName;
            $this->i++;
        }
        Storage::disk($event->pathName)->put($newFileName, file_get_contents($event->file));

        return $newFileName;
    }
}
