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
                'name' => 'initiat',
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
                'name' => 'disburs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
