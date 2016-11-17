<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problem extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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

    public function files()
    {
        return $this->hasMany('App\ProblemFiles');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }
}
