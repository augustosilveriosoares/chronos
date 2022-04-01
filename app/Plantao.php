<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantao extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'cidade_id', 'inicio','fim'];
}
