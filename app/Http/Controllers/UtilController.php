<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\User;
use Illuminate\Http\Request;
use DB;

class UtilController extends Controller
{


    public function transferencia(){

        $advogados = User::where('role_id','=',2)->get();
       // return json_encode($advogados);
        return view('transferencias.index', ['advogados'=>$advogados
            ]);


    }
    public function transfereAtendimentos(Request $resquest){

        $origem = $resquest->input('origem');
        $destino = $resquest->input('destino');
        $start = $resquest->input('start');
        $end = $resquest->input('end');
        $start = $start .' 00:00';
        $end = $end.'T23:59';

        $old = User::find($origem);
        $new = User::find($destino);

        $affected = DB::table('atendimentos as a')
            ->where('user_id', $origem)
            ->where('situacao_id','=',2 )
            ->whereBetween('dataagendamento',[$start,$end])
            ->update(['user_id' => $destino]);



        if($affected != null){
            return back()->withStatus(__('Transferencia Concluída'));
        }else{
            return back()->withErrors(__('Nenhum atendimento para '. $old->name));
        }







    }


}
