<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'colocation_id'
    ];

    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
}
