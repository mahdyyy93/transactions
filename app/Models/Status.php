<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function scopeFindByName($query, $value)
    {
        return $query->where('name', $value)->first();
    }
}
