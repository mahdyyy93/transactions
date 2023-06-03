<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Status;
use App\Enums\StatusEnum;
use App\Models\Transaction;
use Database\Seeders\StatusSeeder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Notifications\TransactionStatusChanged;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTransactionTest extends TestCase
{
    use RefreshDatabase;

    public User $user;
    public User $admin;
    public Transaction $transaction;

    public function setUp(): void 
    {
        parent::setUp();

        Notification::fake();
        
        $this->seed(StatusSeeder::class);

        $this->user = User::factory()->create();
        $this->admin = User::factory()->create(['is_admin' => true]);

        $this->transaction = Transaction::factory()->create(['user_id'=>$this->user->id, 'status_id' => 1]);
    }

    public function test_admin_commit_transaction(): void
    {
        $response = $this->actingAs($this->admin)->post(
            '/api/commit/', 
            [
                'transaction_id' => $this->transaction->id,
                'status_id' => Status::findByName(StatusEnum::COMMIT)->id,
            ]
        );
        
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
            'status_id' => Status::findByName(StatusEnum::COMMIT)->id,
        ]);
        
        Notification::assertSentTo(
            [$this->user], TransactionStatusChanged::class
        );
    }

    public function test_admin_reject_transaction(): void
    {
        $response = $this->actingAs($this->admin)->post(
            '/api/commit/', 
            [
                'transaction_id' => $this->transaction->id,
                'status_id' => Status::findByName(StatusEnum::REJECT)->id,
            ]
        );
        
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
            'status_id' => Status::findByName(StatusEnum::REJECT)->id,
        ]);
        
        Notification::assertSentTo(
            [$this->user], TransactionStatusChanged::class
        );
    }

    public function test_only_admin_can_commit_or_reject_transaction(): void
    {
        $response = $this->actingAs($this->user)->post('/api/commit/', ['transaction_id' => $this->transaction->id]);
        
        $response->assertStatus(403);

        $this->assertDatabaseHas('transactions', [
            'id' => $this->transaction->id,
            'status_id' => $this->transaction->status_id,
        ]);

        Notification::assertNotSentTo(
            [$this->user], TransactionStatusChanged::class
        );
    }
}
