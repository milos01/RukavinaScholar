<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $table = 'problems';
    protected $fillable = [
        
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_from(){
    	return $this->belongsTo('App\User','person_from');
    }

    public function users()
    {
        return $this->belongsToMany('App\User','user_problem');
    }

    public function main_solver(){
        return $this->belongsTo('App\User', 'main_slovler');
    }
}
