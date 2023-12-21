<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientuser extends Model
{
    use HasFactory;

    function client() {
        return $this->hasMany(Client::class);
    }
}
