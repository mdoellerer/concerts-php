<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConcertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'concert_id' => $this->concert_id,
            'concert_date' => $this->concert_date,
            'setlist' => $this->setlist,
            'artist' => $this->artist,
            'concert_type' => $this->concertType,
            'venue' => $this->venue,            
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
          ];
    }
}
