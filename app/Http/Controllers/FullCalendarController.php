<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\Event;
use http\Env\Response;
use Illuminate\Http\Request;
use DB;

class FullCalendarController extends Controller
{
    public function index()
    {
        $events = [];



//        $atendimentos = DB::table('atendimentos as a')
//            ->join('situacaos as s','a.situacao_id','=','s.id')
//            ->where('a.dataagendamento','!=','null')
//            ->where('s.descricao','!=','Cancelado')
//            ->select('a.*')->get();

        $atendimentos = Atendimento::all();

        foreach ($atendimentos as $eve){
            if(!is_null($eve->getDataAgendamento())){
                if($eve->situacao->descricao == 'Agendado'){
                    $event = new Event();
                    $event->atendimento_id = $eve->id;
                    $event->title = $eve->nome;
                    $event->description = $eve->necessidade->descriacao;
                    $event->allDay = false;
                    $event->start = $eve->dataagendamento;
                    $event->user_id = $eve->user_id;
                    $event->color = $eve->user->color;
                    array_push($events,$event);

                }
            }


        }


        $adv = $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->orderBy('users.name', 'asc')->get();


        return view('agendamento.index',['events'=> $events,'advogados'=>$adv]);
    }

    public function show($id)
    {
        $ids = explode(',',$id);
        $events = [];
        $atendimentos = Atendimento::whereIn('user_id',$ids)->get();

        foreach ($atendimentos as $eve){
            if(!is_null($eve->getDataAgendamento())){
                if($eve->situacao->descricao == 'Agendado'){
                    $event = new Event();
                    $event->atendimento_id = $eve->id;
                    $event->title = $eve->nome;
                    $event->description = $eve->necessidade->descriacao;
                    $event->allDay = false;
                    $event->start = $eve->dataagendamento;
                    $event->user_id = $eve->user_id;
                    $event->color = $eve->user->color;
                    array_push($events,$event);

                }
            }
        }


        return response()->json($events);
    }

    public function create(Request $request)
    {
        $insertArr = [ 'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];
        $event = Event::insert($insertArr);
        return Response::json($event);
    }


    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);

        return Response::json($event);
    }


    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();

        return Response::json($event);
    }

}
