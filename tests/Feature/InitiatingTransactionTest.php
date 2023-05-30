<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Database\Seeders\StatusSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InitiatingTransactionTest extends TestCase
{
    use RefreshDatabase;

    public User $user;

    public function setUp(): void 
    {
        parent::setUp();

        $this->seed(StatusSeeder::class);
        $this->user = User::factory()->create();
    }
    
    public function test_example(): void
    {
        $response = $this->actingAs($this->user)->post('/api/transactions', [
            "amount" => 50
        ]);

        $response->assertStatus(201);
        
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->has('data', fn (AssertableJson $json) => 
                    $json
                        ->has('code')
                        ->has('user_id')
                        ->has('amount')
                        ->has('status_id')
                        ->has('id')
                        ->etc()
                )
        );

        $this->assertDatabaseHas('transactions', [
            'id' => $response->decodeResponseJson()['data']['id'],
        ]);
    }
}
