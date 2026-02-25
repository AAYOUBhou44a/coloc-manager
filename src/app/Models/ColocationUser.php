<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColocationUser extends Model
{
    // user_id, colocation_id, role, balance , left_at
    protected $fillable = [
        'user_id',
        'colocation_id',
        'role',
        'balance',
        'left_at'
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'float',
            'left_at' => 'datetime'
        ];
    }
}
