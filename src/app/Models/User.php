<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'global_role',
        'reputation_score',
        'banned_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'reputation_score' => 'decimal:2', //2 décimales après la virgule
            'banned_at' => 'datetime'
        ];
    }

    // On utilise belongsToMany car les données (role, balance) sont dans la table pivot
    public function colocation(){
        return $this->belongsToMany(Colocation::class, 'colocation_user')
        ->withPivot('role','balance','left_at')
        ->withTimestamps();
    }

    public function invitations(){
        return $this->hasMany(Invitation::class);
    }

    public function expensesPaid() {
    return $this->hasMany(Expense::class, 'payer_id');
}

    public function settlements(){
        return $this->hasMany(Settlement::class);
    }
}
