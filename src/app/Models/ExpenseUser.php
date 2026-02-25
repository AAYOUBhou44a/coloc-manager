<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ExpenseUser extends Pivot
{
    protected $fillable = [
        'expense_id',
        'user_id',
        'shared_amount'
    ];

    protected function casts(): array
    {
        return
        [
            'shared_amount' => 'float'
        ];
    }
}
