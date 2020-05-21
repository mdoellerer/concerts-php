<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    protected $fillable = ['concert_date', 'setlist'];

    public function artists(){
        return $this->belongsTo('App\Artist');
    }

    public function concertTypes(){
        return $this->belongsTo('App\ConcertType');
    }

    public function venues(){
        return $this->belongsTo('App\Venue');
    }
}
