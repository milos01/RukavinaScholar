<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;

class UserComposer
{
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $myAssigns = Auth::user()->problems()->where('read', 0)->get();
        $view->with('assigns', count($myAssigns));
    }
}