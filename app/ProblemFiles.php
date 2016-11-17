<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemFiles extends Model
{
    protected $table = 'problem_files';
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
