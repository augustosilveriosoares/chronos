<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\Event;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

class FullCalendarController extends Controller
{
    public function index()
    {
        $events = [];

        $atendimentos = Atendimento::whereIn('user_id', session('adv_ids') ?? [])->where('situacao_id', 2)->get();

        foreach ($atendimentos as $eve) {
            if (!is_null($eve->getDataAgendamento())) {
                if ($eve->situacao->descricao == 'Agendado') {
                    $event = new Event();
                    $event->atendimento_id = $eve->id;
                    //                    $event->title =  substr($eve->tipoatendimento->descricao,0,1) .' - '. $eve->nome;
                    $event->title =   $eve->nome;
                    $event->description = $eve->necessidade->descriacao;
                    $event->allDay = false;
                    $event->start = $eve->dataagendamento;
                    $event->user_id = $eve->user_id;
                    $event->color = $eve->user->color;

                    if ($eve->tipoatendimento->id = 1 || $eve->tipoatendimento->id = 2) {
                        if ($eve->dataagendamento > now()) {
                            array_push($events, $event);
                        }
                    }
                }
            }
            $lembretes = Event::where('user_id', auth()->user()->id)->get();
            foreach ($lembretes as $lem) {
                $event = new Event();
                $event->id = $lem->id;
                $event->title = $lem->title;
                $event->allDay = $lem->isAllDay();
                $event->start = $lem->start;
                $event->user_id = $lem->user_id;
                $event->color = $lem->color;
                array_push($events, $event);
            }
        }


        $adv = $advogado = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('roles.name', '=', 'Advogado')->select('users.*')->orderBy('users.name', 'asc')->get();

        return view('agendamento.full', ['events' => json_encode($events), 'advogados' => $adv]);
    }

    public function events(Request $request)
    {
        $events = [];

        //  $atendimentos = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where('s.descricao','=','Agendado')->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$request->start,$request->end])->get();

        $atendimentos = Atendimento::whereIn('user_id', session('adv_ids') ?? [])->whereBetween('dataagendamento', [$request->start, $request->end])->get();

        foreach ($atendimentos as $eve) {
            if (!is_null($eve->getDataAgendamento())) {
                if ($eve->situacao->descricao == 'Agendado') {

                    $date = new \DateTime($eve->dataagendamento);
                    $hoje = new \DateTime("today");
                    $event = new Event();
                    $event->atendimento_id = $eve->id;
                    $event->id = $eve->id;
                    $event->title =  $eve->nome;
                    $event->description = $eve->necessidade->descriacao;
                    $event->allDay = false;
                    $event->start = $eve->dataagendamento;
                    $event->user_id = $eve->user_id;
                    $event->color = $eve->user->color;

                    switch ($eve->tipoatendimento->id) {
                        case 3:
                            // se for Informação
                            if ($date >= $hoje) {
                                array_push($events, $event);
                            }
                            break;
                        case 4:
                            // se for orientacao
                            if ($date >= $hoje) {
                                array_push($events, $event);
                            }
                            break;
                        case 2:
                            array_push($events, $event);
                            break;

                        case 3:
                            array_push($events, $event);
                            break;
                            //TODO: verificar se precisa remover:
                        default:
                            array_push($events, $event);
                    }
                }
            }
        }

        $lembretes = Event::whereBetween('start', [$request->start, $request->end])->where('user_id', auth()->user()->id)->get();
        foreach ($lembretes as $lem) {

            $event = new Event();
            $event->id = $lem->id;
            $event->title = $lem->title;
            $event->allDay = $lem->isAllDay();
            $event->start = $lem->start;
            $event->user_id = $lem->user_id;
            $event->color = $lem->color;

            array_push($events, $event);
        }

        return json_encode($events);
    }

    public function show($id)
    {
        $ids = explode(',', $id);
        $events = [];
        array_push($ids, auth()->user()->id);
        session(['adv_ids'=>$ids]);
        //dd(session('adv_ids'));

        $atendimentos = Atendimento::whereIn('user_id', $ids)->get();
        
        foreach ($atendimentos as $eve) {
            if (!is_null($eve->getDataAgendamento())) {
                if ($eve->situacao->descricao == 'Agendado') {

                    $date = new \DateTime($eve->dataagendamento);
                    $hoje = new \DateTime("today");

                    $event = new Event();
                    $event->atendimento_id = $eve->id;
                    $event->title = $eve->nome;
                    $event->description = $eve->necessidade->descriacao;
                    $event->allDay = false;
                    $event->start = $eve->dataagendamento;
                    $event->user_id = $eve->user_id;
                    $event->color = $eve->user->color;
                    switch ($eve->tipoatendimento->id) {
                        case 3:
                            // se for Informação
                            if ($date >= $hoje) {
                                array_push($events, $event);
                            }
                            break;
                        case 4:
                            // se for orientacao
                            if ($date >= $hoje) {
                                array_push($events, $event);
                            }
                            break;
                        case 2:
                            array_push($events, $event);
                            break;

                        case 3:
                            array_push($events, $event);
                            break;
                        //TODO: verificar se precisa remover:
                        default:
                        array_push($events, $event);
                    }
                }
            }
        }
        $lembretes = Event::whereIn('user_id', $ids)->get();
        foreach ($lembretes as $lem) {

            $event = new Event();
            $event->id = $lem->id;
            $event->title = $lem->title;
            $event->allDay = $lem->isAllDay();
            $event->start = $lem->start;
            $event->user_id = $lem->user_id;
            $event->color = $lem->color;

            array_push($events, $event);
        }


        return response()->json($events);
    }

    public function create(Request $request)
    {
        $insertArr = [
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];
        $event = Event::insert($insertArr);
        return Response::json($event);
    }


    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);

        return Response::json($event);
    }


    public function destroy(Request $request)
    {
        $event = Event::where('id', $request->id)->delete();

        return Response::json($event);
    }
}
