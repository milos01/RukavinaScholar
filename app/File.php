<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = [
        
    ];

    
    protected $hidden = [
        
    ];

    public function problem()
    {
        return $this->belongsTo('App\Problem');
    }
}
