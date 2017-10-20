<?php

namespace App;

use App\Helpers\Hasher;
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['hash_id'];

    protected $fillable = [
        'subject',
        'person_from',
        'main_slovler',
        'problem_type',
        'problem_description',
        'sol_description',
        'took',
        'waiting',
        'time_ends_at'
    ];

    protected $hidden = [];

    public function getHashIdAttribute()
    {
        return Hasher::encode($this->attributes['id']);
    }

    public function user_from(){
    	return $this->belongsTo('App\User','person_from');
    }

    public function task_type(){
        return $this->belongsTo('App\ProblemCategory','problem_type');
    }

    public function users()
    {
        return $this->belongsToMany('App\User','user_problem');
    }

    public function mainSolver(){
        return $this->belongsTo('App\User', 'main_slovler');
    }

    public function files()
    {
        return $this->belongsToMany('App\File', 'problem_files', 'problem_id', 'file_id');
    }

    public function solutions()
    {
        return $this->belongsToMany('App\File', 'problem_solution_files', 'problem_id', 'solution_file_id');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }
}
