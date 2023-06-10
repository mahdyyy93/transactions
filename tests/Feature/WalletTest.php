<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Enums\StatusEnum;
use Database\Seeders\StatusSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WalletTest extends TestCase
{    
    use RefreshDatabase;

    public User $user;

    public User $admin;

    public function setUp(): void 
    {
        parent::setUp();

        Notification::fake();

        $this->seed(StatusSeeder::class);
        
        $this->user = User::factory()->create();
        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    public function test_credit_is_not_enough(): void
    {
        $this->assertEquals($this->user->wallet->credit, 5000);

        $this->actingAs($this->user)->post('/api/transactions', [
            "amount" => $this->user->wallet->credit+1
        ]);

        $this->assertEquals($this->user->wallet->credit, 5000);
    }

    public function test_credit_is_validated(): void
    {
        $this->assertEquals($this->user->wallet->credit, 5000);

        $response = $this->actingAs($this->user)->post('/api/transactions', [
            "amount" => 5000
        ]);

        $this->actingAs($this->admin)->post(
            '/api/commit/', 
            [
                'transaction_id' => $response->decodeResponseJson()['data']['id'],
                'status_id' => StatusEnum::commit->value,
            ]
        );

        $this->assertEquals($this->user->wallet->credit, 0);
    }
}
