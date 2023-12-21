<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SbFixture extends Model
{
    use HasFactory;
    protected $table = 'sb_fixtures';


    public static $_table = "sb_fixtures";

    protected $connection = 'sb_rds';
}
