<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    protected $fillable = ['concert_date', 'setlist', 'concert_type_id', 'artist_id', 'venue_id'];

    public function artists(){
        return $this->belongsTo('App\Artist', 'artist_id', 'id');
    }

    public function concertTypes(){
        return $this->belongsTo('App\ConcertType', 'concert_type_id', 'id');
    }

    public function venues(){
        return $this->belongsTo('App\Venue', 'venue_id', 'id');
    }
}
