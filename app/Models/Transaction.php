<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'code',
        'user_id',
        'amount',
        'status_id',
    ];

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function scopeFilterByUserIfNotAdmin(Builder $query, $user = null)
    {
        if ($user === null) {
            $user = Auth::user();
        }
    
        if ($user && !$user->is_admin) {
            return $query->where('user_id', $user->id);
        }
    
        return $query;
    }
    
    public function getCodeAttribute()
    {
        return strtoupper($this->attributes['code']);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }
}
