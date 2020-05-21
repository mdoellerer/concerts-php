<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = ['name', 'country'];

    public function concerts(){
        return $this->hasMany('App\Concert');
    }
}
