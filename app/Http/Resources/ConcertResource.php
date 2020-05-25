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
            'concert_id' => $this->id,
            'concert_date' => $this->concert_date,
            'setlist' => $this->setlist,
            'artist' => $this->artists,
            'concert_type' => $this->concertTypes,
            'venue' => $this->venues,            
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
          ];
    }
}
