<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAtendimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
    ];

    public function atendimento()
    {

        return $this->hasMany(Atendimento::class,'tipoatendimento_id');
    }
}
