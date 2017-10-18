<?php

namespace App\Providers;

use App\User;
use App\Problem;
use Auth, DB, Event;
use Validator;
use Hash;
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
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {

            return Hash::check($value, current($parameters));

        });

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

        if (env('APP_ENV') === 'local') {
            DB::connection()->enableQueryLog();
        }
        if (env('APP_ENV') === 'local') {
            Event::listen('kernel.handled', function ($request, $response) {
                if ( $request->has('sql-debug') ) {
                    $queries = DB::getQueryLog();
                    dump($queries);
                }
            });
        }
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
