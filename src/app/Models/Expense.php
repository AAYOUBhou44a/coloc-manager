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

    public function user() {
    // On précise que la clé étrangère est payer_id
    return $this->belongsTo(User::class, 'payer_id');
}

public function sharedWith()
{
    // Les utilisateurs qui partagent cette dépense via la table pivot
    return $this->belongsToMany(User::class, 'expense_user')
                ->withPivot('shared_amount')
                ->withTimestamps();
}

public function users() {
    // Relation avec les membres qui partagent la dépense via la table pivot expense_user
    return $this->belongsToMany(User::class, 'expense_user')
                ->withPivot('shared_amount')
                ->withTimestamps();
}

    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

