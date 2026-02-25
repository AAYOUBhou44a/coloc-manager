<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'owner_id',
        'user_id',
        'email',
        'token',
        'status',
        'colocation_id'
    ];
}
