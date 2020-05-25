<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConcertType;
use App\Http\Resources\ConcertTypeResource;

class ConcertTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConcertTypeResource::collection(ConcertType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $concert_type = ConcertType::firstOrCreate([
            'description' => $request->description,
          ]);

        return new ConcertTypeResource($concert_type);
    }

    /**
     * Display the specified resource.
     *
     * @param  ConcertType $concertType
     * @return \Illuminate\Http\Response
     */
    public function show(ConcertType $concertType)
    {
        return new ConcertTypeResource($concertType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
