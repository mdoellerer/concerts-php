<?php 

namespace Tests\Feature;

use App\User;
use App\Artist;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtistTest extends TestCase
{

    public function testsArtistsAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name' => 'Lorem',
            'country' => 'Ipsum',
        ];

        $this->json('POST', '/api/artists', $payload, $headers)
            ->assertStatus(201)
            ->assertJson(['data' => ['id' => 1, 'name' => 'Lorem', 'country' => 'Ipsum']])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'country', 'created_at', 'updated_at'],
            ]);
    }


    public function testsArtistsAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $artist = factory(Artist::class)->create([
            'name' => 'First Artist',
            'country' => 'First Artist Country',
        ]);

        $payload = [
            'name' => 'Lorem',
            'country' => 'Ipsum',
        ];

        $response = $this->json('PUT', '/api/artists/' . $artist->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => 1, 'name' => 'Lorem', 'country' => 'Ipsum']]);
    }


    public function testsArtistsAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $artist = factory(Artist::class)->create([
            'name' => 'First Artist',
            'country' => 'First artist country',
        ]);

        $this->json('DELETE', '/api/artists/' . $artist->id, [], $headers)
            ->assertStatus(204);
    }

    
    public function testArtistsAreListedCorrectly()
    {
        factory(Artist::class)->create([
            'name' => 'First artist',
            'country' => 'First artist country'
        ]);

        factory(Artist::class)->create([
            'name' => 'Second artist',
            'country' => 'Second artist country'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/artists', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    ['id' => 1, 'name' => 'First artist', 'country' => 'First artist country' ],
                    ['id' => 2, 'name' => 'Second artist', 'country' => 'Second artist country' ],
                ]
            
            ]);
    }

}