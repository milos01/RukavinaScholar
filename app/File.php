<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'fileName'
    ];

    protected $hidden = [];

    public function problems()
    {
        return $this->belongsToMany('App\Problem', 'problem_files', 'problem_id', 'file_id')->withTimestamps();
    }
}
