<?php

namespace App\Providers;

use App\User;
use App\Problem;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->share('key', 'value');

        User::deleting(function ($user) {
            $problems = Problem::all();
            foreach ($problems as $problem) {
                if ($problem->person_from == $user->id) {
                    $problem->delete();
                }
            }
            return $problems;
        });

        User::updating(function ($user) {
            $problems = Problem::onlyTrashed()->get();
            foreach ($problems as $problem) {
                if ($problem->person_from == $user->id) {
                    $problem->restore();
                }
            }
            return $problems;
        });
        
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
