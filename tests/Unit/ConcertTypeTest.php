<?php 

namespace Tests\Feature;

use App\User;
use App\ConcertType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConcertTypeTest extends TestCase
{

    public function testsConcertTypesAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'description' => 'Lorem Ipsum',
        ];

        $this->json('POST', '/api/concertTypes', $payload, $headers)
            ->assertStatus(201)
            ->assertJson(['data' => ['id' => 1, 'description' => 'Lorem Ipsum']])
            ->assertJsonStructure([
                '*' => ['id', 'description', 'created_at', 'updated_at'],
            ]);
    }


   
    public function testConcertTypesAreListedCorrectly()
    {
        factory(ConcertType::class)->create([
            'description' => 'First concertType',
        ]);

        factory(ConcertType::class)->create([
            'description' => 'Second concertType',
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/concertTypes', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    ['id' => 1, 'description' => 'First concertType'],
                    ['id' => 2, 'description' => 'Second concertType'],
                ]
            
            ]);
    }

}