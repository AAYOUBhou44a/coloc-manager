<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'category_id',
        'payer_id',
        'colocation_id'
    ];

    protected function casts(): array
    {
        return[
            'amount' => 'float'
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
}
