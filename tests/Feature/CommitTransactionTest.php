<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use Database\Seeders\StatusSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommitTransactionTest extends TestCase
{
    use RefreshDatabase;

    public User $user;
    public User $admin;
    public Transaction $transaction;

    public function setUp(): void 
    {
        parent::setUp();

        $this->seed(StatusSeeder::class);

        $this->user = User::factory()->create();
        $this->admin = User::factory()->create(['is_admin' => true]);

        $this->transaction = Transaction::factory()->create(['user_id'=>$this->user->id, 'status_id' => 1]);
    }

    public function test_admin_commit_transaction(): void
    {
        $response = $this->actingAs($this->admin)->post('/api/commit/', ['transaction_id' => $this->transaction->id]);
        
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
            'id' => $this->transaction->id,
            'status_id' => 2,
        ]);
    }


    public function test_only_admin_commit_transaction(): void
    {
        $response = $this->actingAs($this->user)->post('/api/commit/', ['transaction_id' => $this->transaction->id]);
        
        $response->assertStatus(403);

        $this->assertDatabaseHas('transactions', [
            'id' => $this->transaction->id,
            'status_id' => $this->transaction->status_id,
        ]);
    }
}
