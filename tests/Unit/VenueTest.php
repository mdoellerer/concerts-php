<?php 

namespace Tests\Feature;

use App\User;
use App\Venue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VenueTest extends TestCase
{

    public function testsVenuesAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name' => 'myvenue',
            'city' => 'myvenuecity',
            'country' => 'myvenuecountry',
        ];

        $this->json('POST', '/api/venues', $payload, $headers)
            ->assertStatus(201)
            ->assertJson(['data' => ['id' => 1, 'name' => 'myvenue', 'city' => 'myvenuecity', 'country' => 'myvenuecountry']])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'city', 'country', 'created_at', 'updated_at'],
            ]);
    }


    public function testsVenuesAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $venue = factory(Venue::class)->create([
            'name' => 'myvenue',
            'city' => 'myvenuecity',
            'country' => 'myvenuecountry',
        ]);

        $payload = [
            'name' => 'othervenue',
            'city' => 'othercity',
            'country' => 'othercountry',
        ];

        $response = $this->json('PUT', '/api/venues/' . $venue->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => 1, 'name' => 'othervenue', 'city' => 'othercity', 'country' => 'othercountry']]);
    }


    public function testsVenuesAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $venue = factory(Venue::class)->create([
            'name' => 'First Venue',
            'city' => 'First venue city',
            'country' => 'First venue country',
        ]);

        $this->json('DELETE', '/api/venues/' . $venue->id, [], $headers)
            ->assertStatus(204);
    }

    
    public function testVenuesAreListedCorrectly()
    {
        factory(Venue::class)->create([
            'name' => 'First venue',
            'city' => 'First venue city',
            'country' => 'First venue country'
        ]);

        factory(Venue::class)->create([
            'name' => 'Second venue',
            'city' => 'Second venue city',
            'country' => 'Second venue country'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/venues', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    ['id' => 1, 'name' => 'First venue', 'city' => 'First venue city', 'country' => 'First venue country' ],
                    ['id' => 2, 'name' => 'Second venue', 'city' => 'Second venue city', 'country' => 'Second venue country' ],
                ]
            
            ]);
    }

}