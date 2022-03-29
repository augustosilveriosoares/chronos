<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atuacao extends Model
{
    use HasFactory;
    protected $fillable = [
        'descricao',
    ];

    public function atendimento()
    {

        return $this->hasMany(Atendimento::class,'atuacao_id');
    }
}
