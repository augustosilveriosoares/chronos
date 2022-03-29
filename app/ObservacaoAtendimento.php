<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservacaoAtendimento extends Model
{
    use HasFactory;
    protected $fillable = [
        'descricao',
        'user_id',
        'atendimento_id',
        'data',


    ];

    public function atendimento()
    {
        return $this->belongsTo(Atendimento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
