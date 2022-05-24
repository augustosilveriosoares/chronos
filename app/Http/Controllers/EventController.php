<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\Event;
use http\Env\Response;
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

    public function full()
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


        return view('agendamento.full',['events'=> $events,'advogados'=>$adv]);
    }

    public function store(Request $request, Event $event)
    {
        //$event->user_id = $usuario logado
       // 'atendimento_id', 'title', 'description', 'allDay', 'start', 'end','user_id','color'

        $event = new Event();
        $event->user_id = auth()->user()->id;
        $event->title = $request->input('title');


        if($request->input ('allDay') == 'on'){
            $event->allDay = 1;
        }else{
            $event->allDay = 0;
        }
        $event->start = $request->input('startEvent');
        $event->color = '#db3018';

        try{
            $event->save();
            return response()->json(['success' => $event], 200);
//            return Response::json(['success' => $event], 200);
        }catch (\Exception $e){
//            return Response::json(['error' => $e], 500);
            return response()->json(['error' => $e], 500);


        }


    }

    public function update(Request $request, Event $event){

        $event = Event::find($request->input('eventIdEdit'));
        $event->title = $request->input('titleEdit');


        if($request->input ('allDayEdit') == 'on'){
            $event->allDay = 1;
        }else{
            $event->allDay = 0;
        }
        $event->start = $request->input('startEventEdit');


        try{
            $event->update();
            return response()->json(['success' => $event], 200);
//            return Response::json(['success' => $event], 200);
        }catch (\Exception $e){
//            return Response::json(['error' => $e], 500);
            return response()->json(['error' => $e], 500);


        }

    }

    public function destroy(Request $request, Event $event){

        try{
            $event = Event::find($request->input('eventIdEdit'));
            $event->delete();
            return response()->json(['success' => $event], 200);
//            return Response::json(['success' => $event], 200);
        }catch (\Exception $e){
//            return Response::json(['error' => $e], 500);
            return response()->json(['error' => $e], 500);


        }

    }
}
