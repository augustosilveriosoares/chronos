<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'agendado',
        'analise',
        'futuro',
        'consultoria',
        'pendente',
        'processo'
    ];

}
