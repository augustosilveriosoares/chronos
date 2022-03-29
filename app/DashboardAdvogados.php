<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardAdvogados extends User
{
    use HasFactory;

    protected $fillable = [
        'total',
        'totalagendado',
        'totalconcluido',
        'totalprocesso',


    ];
}
