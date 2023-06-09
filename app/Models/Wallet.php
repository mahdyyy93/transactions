<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'balance',
    ];

    public $appends = ['credit'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreditAttribute(): int
    {   
        return $this->balance - $this->user->transactions()
            ->whereIn('status_id', [StatusEnum::COMMIT])
            ->sum('amount');
    }
}
