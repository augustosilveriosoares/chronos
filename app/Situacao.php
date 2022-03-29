<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    use HasFactory;
    protected $fillable = [
        'descricao',
        'cor'

    ];

    public function atendimento()    {

        return $this->hasMany(Atendimento::class,'situacao_id', 'id');
    }
}
