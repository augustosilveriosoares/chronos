<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametroAtendimento extends Model
{
    use HasFactory;

    protected $fillable = ['tempo','onlyMyCity'];

    public function onlyMyCity(){
        if ($this->onlyMyCity == 1){
            return true;
        }else{
            return false;
        }
    }
}
