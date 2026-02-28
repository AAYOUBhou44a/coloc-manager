<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = [
        'name',
        'status',
        'owner_id'
    ];

    // on ne doit pas utiliser ici hasMany car il n'y a pas de colocation_id dans la table user , mais il y un table pivot qui relie les deux , donc belongsToMany
    public function users(){
        return $this->belongsToMany(User::class, 'colocation_user')
        ->withPivot('role','balance','left_at')
        ->withTimestamps();
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function invitations(){
        return $this->hasMany(Invitation::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function settlements(){
        return $this->hasMany(Settlement::class);
    }

}
