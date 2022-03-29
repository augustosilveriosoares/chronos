<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Necessidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',


    ];

    public function atendimento()
    {

        return $this->hasMany(Atendimento::class,'necessidade_id');
    }
}
