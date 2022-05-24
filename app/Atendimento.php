<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;
    protected $fillable = [
        'situacao_id',
        'sexo_id',
        'atuacao_id',
        'necessidade_id',
        'user_id',
        'nome',
        'idade',
        'anoscontribuicao',
        'whats',
        'email',
        'mensagem',
        'datacadastro',
        'dataagendamento',
        'cidade_id',
        'online',
        'tipoatendimento_id',
        'created_by',
        'criadopor',
        'deleted_by',
        'updated_by'


    ];

    public function situacao(){

        return $this->belongsTo(Situacao::class);

    }
    public function sexo(){

        return $this->belongsTo(Sexo::class);

    }
    public function atuacao(){

        return $this->belongsTo(Atuacao::class);

    }
    public function necessidade(){

        return $this->belongsTo(Necessidade::class);

    }
    public function user(){

        return $this->belongsTo(User::class);

    }

    public function cidade(){

        return $this->belongsTo(Cidade::class);

    }

    public function observacoes()
    {
        return $this->hasMany(ObservacaoAtendimento::class);

    }

    public function getDataAgendamento(){
        return Carbon::parse($this->dataagendamento)->format('Y-m-d\TH:i');
    }

    public function agendamentos(){

        return $this->belongsTo(Event::class);

    }
    public function tipoatendimento(){

        return $this->belongsTo(TipoAtendimento::class);

    }

    public function isOnline(){

        if($this->online == null){
            return false;
        }
        else if ($this->online == 1){
            return true;
        }else{
            return false;
        }
    }

    public function isRetorno(){

        return($this->retorno == 1);
        if ($this->retorno == 1){
            return true;
        }else{
            return false;
        }
    }





}
