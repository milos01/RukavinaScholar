<?php

namespace App\Listeners;

use App\User;
use Storage;
use DefaultProfileImage;
use App\Events\makeProfilePictureEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class makeProfilePictureHandler
{
    public $now;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->now = time();
    }

    /**
     * Handle the event.
     *
     * @param  makeProfilePictureEvent  $event
     * @return void
     */
    public function handle(makeProfilePictureEvent $event)
    {
        $img = DefaultProfileImage::create($event->name." ".$event->last_name, 256);
        Storage::disk('avatar_uploads')->put($this->getFileName(), $img->encode());

        $this->updateUser($event->email);
    }

    private function getFileName(){
        return $this->now.".png";
    }

    private function updateUser($email){
        $user = User::where('email', $email)->first();
        $user->picture = $this->getFileName();
        $user->save();
    }
}
