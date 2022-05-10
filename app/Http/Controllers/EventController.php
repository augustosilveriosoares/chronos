<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\Event;
use Illuminate\Http\Request;
use DB;
use mysql_xdevapi\Table;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $events = [];
//        $att = DB::table('atendimentos as a')
//                ->join('situacaos as s','s.id','=','a.situacao_id')
//                ->where('s.descricao','=','Agendado')
//                ->whereNotNull('dataagendamento')
//                ->select('a.*')->get();
//
//        foreach ($att as $at){
//            $event = new Event();
//            $event->atendimento_id = $at->id;
//            $event->title = $at->nome;
//            $event->start = $at->dataagendamento;
//            $event->user_id
//
//
//        }
        $events = Event::all();


        $adv = $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->orderBy('users.name', 'asc')->get();


        return view('agendamento.index',['events'=> $events,'advogados'=>$adv]);
    }
}
