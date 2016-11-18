<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemSolutions extends Model
{
    protected $table = 'problem_solutions';
    protected $fillable = [
        
    ];

    
    protected $hidden = [
        
    ];

    public function problem()
    {
        return $this->belongsTo('App\Problem');
    }

    public function file()
    {
        return $this->belongsTo('App\File');
    }
}
