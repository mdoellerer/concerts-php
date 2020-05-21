<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = ['name', 'city', 'country'];

    public function concerts(){
        return $this->hasMany('App\Concert');
    }
}
