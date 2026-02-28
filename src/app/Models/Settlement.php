<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $fillable = [
        'payer_id',
        'payee_id',
        'settlement',
        'colocation_id',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'settlement' => 'float'
        ];
    }

    public function user(){
        return $this->belongsTo(Settlement::class);
    }

    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
}
