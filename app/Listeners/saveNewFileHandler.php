<?php

namespace App\Listeners;

use App\Events\saveNewFileEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class saveNewFileHandler
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
     * @param  saveNewFileEvent  $event
     * @return void
     */
    public function handle(saveNewFileEvent $event)
    {
        // dd($event->req->file->originalName);
    }
}
