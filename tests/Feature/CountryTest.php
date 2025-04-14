<?php

namespace Tests\Feature;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test-token')->plainTextToken;
    }

    public function test_user_can_create_country()
    {
        $countryData = [
            'name' => 'Canada',
            'capital' => 'Ottawa',
            'population' => 38000000,
            'region' => 'Americas',
            'subregion' => 'North America',
            'currency' => 'Canadian dollar',
            'language' => 'English, French',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/countries', $countryData);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'name' => 'Canada',
                     'capital' => 'Ottawa',
                 ]);
        
        $this->assertDatabaseHas('countries', [
            'name' => 'Canada',
        ]);
    }

    public function test_user_can_get_all_countries()
    {
        Country::factory()->count(3)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/countries');

        $response->assertOk()
                 ->assertJsonCount(3);
    }

    public function test_user_can_get_single_country()
    {
        $country = Country::factory()->create([
            'name' => 'Australia',
            'capital' => 'Canberra',
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/countries/' . $country->id);

        $response->assertOk()
                 ->assertJson([
                     'name' => 'Australia',
                     'capital' => 'Canberra',
                 ]);
    }

    public function test_user_can_update_country()
    {
        $country = Country::factory()->create([
            'name' => 'Australia',
            'capital' => 'Canberra',
        ]);

        $updateData = [
            'capital' => 'Sydney', // incorrect but for testing purpose
            'population' => 25000000,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->putJson('/api/countries/' . $country->id, $updateData);

        $response->assertOk()
                 ->assertJsonFragment([
                     'name' => 'Australia',
                     'capital' => 'Sydney',
                     'population' => 25000000,
                 ]);
        
        $this->assertDatabaseHas('countries', [
            'id' => $country->id,
            'capital' => 'Sydney',
        ]);
    }

    public function test_user_can_delete_country()
    {
        $country = Country::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->deleteJson('/api/countries/' . $country->id);

        $response->assertOk()
                 ->assertJson(['message' => 'Country deleted successfully']);
        
        $this->assertDatabaseMissing('countries', [
            'id' => $country->id,
        ]);
    }
}
