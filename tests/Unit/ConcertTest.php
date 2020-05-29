<?php 

namespace Tests\Feature;

use App\User;
use App\Artist;
use App\Venue;
use App\ConcertType;
use App\Concert;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConcertTest extends TestCase
{
    private $artist_id;
    private $concert_type_id;
    private $venue_id;

    private function createConcertDependencies(){
        $artist = factory(Artist::class)->create([
            'name' => 'Artist',
            'country' => 'Artist country',
        ]);

        $this->artist_id = $artist->id;

        $venue = factory(Venue::class)->create([
            'name' => 'Venue',
            'city' => 'Venue city',
            'country' => 'Venue country',
        ]);

        $this->venue_id = $venue->id;

        $concert_type = factory(ConcertType::class)->create([
            'description' => 'Concert Type',
        ]);

        $this->concert_type_id = $concert_type->id;
    }

    public function testsConcertsAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $this->createConcertDependencies();

        $payload = [
            'concert_date' => '2020-11-22', 
            'setlist' => 'song1, song2, song3, song4', 
            'concert_type_id' => $this->concert_type_id, 
            'artist_id' => $this->artist_id, 
            'venue_id' => $this->venue_id, 
        ];

        $this->json('POST', '/api/concerts', $payload, $headers)
            ->assertStatus(201)
            ->assertJson(['data' => [
                'concert_date' => '2020-11-22', 
                'setlist' => 'song1, song2, song3, song4', 
                'concert_type' => [ 'id' => $this->concert_type_id, 'description' => 'Concert Type'],
                'artist' => [ 'id' => $this->artist_id, 'name' => 'Artist', 'country' => 'Artist country'],
                'venue' => [ 'id' => $this->venue_id, 'name' => 'Venue', 'city' => 'Venue city', 'country' => 'Venue country'],
            ]])
            ->assertJsonStructure([
                '*' => ['concert_id', 'concert_date', 'setlist', 'concert_type', 'artist', 'venue', 'created_at', 'updated_at'],
            ]);
    }


    public function testsArtistsAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $this->createConcertDependencies();

        $concert = factory(Concert::class)->create([
            'concert_date' => '2020-11-22', 
            'setlist' => 'song1, song2, song3, song4', 
            'concert_type_id' => $this->concert_type_id,
            'artist_id' => $this->artist_id,
            'venue_id' => $this->venue_id,
        ]);

        $payload = [
            'concert_date' => '2011-02-22',
            'setlist' => 'song1, song5, song3, song6', 
        ];

        $response = $this->json('PUT', '/api/artists/' . $concert->id, $payload, $headers)
            ->assertStatus(200);
            #TODO
            #->assertJson(['data' => ['concert_id' => 1, 'concert_date' => '2011-02-22', 'setlist' => 'song1, song5, song3, song6' ]]);
    }

    public function testsConcertsAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $this->createConcertDependencies();

        $concert = factory(Concert::class)->create([
            'concert_date' => '2020-11-22', 
            'setlist' => 'song1, song2, song3, song4', 
            'concert_type_id' => $this->concert_type_id,
            'artist_id' => $this->artist_id,
            'venue_id' => $this->venue_id,
        ]);

        $this->json('DELETE', '/api/concerts/' . $concert->id, [], $headers)
            ->assertStatus(204);
    }

    public function testConcertsAreListedCorrectly()
    {
        $this->createConcertDependencies();

        $concert = factory(Concert::class)->create([
            'concert_date' => '2018-07-07', 
            'setlist' => 'song1, song2, song3, song4', 
            'concert_type_id' => $this->concert_type_id,
            'artist_id' => $this->artist_id,
            'venue_id' => $this->venue_id,
        ]);

        $concert = factory(Concert::class)->create([
            'concert_date' => '2020-11-22', 
            'setlist' => 'song15, song4, song21, song1', 
            'concert_type_id' => $this->concert_type_id,
            'artist_id' => $this->artist_id,
            'venue_id' => $this->venue_id,
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/concerts', [], $headers)
            ->assertStatus(200);
            // ->assertJson([
            //     'data' => [
            //         ['concert_id' => 1, 'concert_date' => '2011-02-22', 'setlist' => 'song1, song2, song3, song4' ],
            //         ['concert_id' => 2, 'concert_date' => '2020-11-22', 'setlist' => 'song15, song4, song21, song1' ],
            //     ]
            
            // ]);
    }


}