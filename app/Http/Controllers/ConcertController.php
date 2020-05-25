<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concert;
use App\Http\Resources\ConcertResource;

class ConcertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConcertResource::collection(Concert::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $concert = Concert::create([
            'concert_date' => $request->concert_date,
            'setlist' => $request->setlist,
            'concert_type_id' => $request->concert_type_id,
            'artist_id' => $request->artist_id,
            'venue_id' => $request->venue_id,
          ]);
    
          return new ConcertResource($concert);
    }

    /**
     * Display the specified resource.
     *
     * @param  Concert $concert
     * @return \Illuminate\Http\Response
     */
    public function show(Concert $concert)
    {
        return new ConcertResource($concert);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Concert $concert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concert $concert)
    {
        $concert->update($request->only(['concert_date', 'setlist']));

        return new ConcertResource($concert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Concert $concert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concert $concert)
    {
        $concert->delete();

        return response()->json(null, 204);
    }
}
