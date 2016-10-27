<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = [
        
    ];

    
    protected $hidden = [];

    public function problem()
    {
        return $this->belongsTo('App\Problem');
    }

    public function personFrom(){
        return $this->belongsTo('App\User', 'person_from');
    }

}
