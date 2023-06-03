<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use Database\Seeders\StatusSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserListTransactionsTest extends TestCase
{
    use RefreshDatabase;

    public Collection $users;
    public User $admin;

    public function setUp(): void 
    {
        parent::setUp();

        Notification::fake();

        $this->seed(StatusSeeder::class);
        $this->users = User::factory()->count(2)->create();
        $this->admin = User::factory()->create(['is_admin' => true]);
        Transaction::factory()->count(2)->create(['user_id'=>$this->users[0]->id]);
        Transaction::factory()->count(3)->create(['user_id'=>$this->users[1]->id]);
    }

    public function test_first_user_gets_his_transaction(): void
    {
        $response = $this->actingAs($this->users[0])->get('/api/transactions');

        $response->assertJsonCount(2, 'data');
        $response->assertStatus(200);
    }

    public function test_admin_gets_transaction_of_all_users(): void
    {
        $response = $this->actingAs($this->admin)->get('/api/transactions');

        $response->assertJsonCount(5, 'data');
        $response->assertStatus(200);
    }
}
