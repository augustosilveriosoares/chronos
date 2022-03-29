<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    use HasFactory;
    protected $fillable = [
        'descricao',


    ];

    public function atendimento()
    {

        return $this->hasMany(Atendimento::class,'sexo_id');
    }
}
