<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::insert([
            [
                'name' => 'initiate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'commit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'reject',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'penality',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'disburse',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
