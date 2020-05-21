<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConcertType extends Model
{
    protected $fillable = ['description'];

    public function concerts(){
        return $this->hasMany('App\Concert');
    }
}
