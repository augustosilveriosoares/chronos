<?php

namespace App\Http\Controllers;
use App\Dashboard;
use App\DashboardAdvogados;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index( Request  $request)
    {

        $datainicial = date('Y-m-d', strtotime('01-01-2022'));;
        $datafinal = Carbon::now();

        if($request->has('dataincial')){
            $datainicial = $request->input('dataincial');
        }
        if($request->has('datafinal')){
            $datafinal = $request->input('datafinal');
        }

        $dashboard = new Dashboard();
        $dashboard->total = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where('s.descricao','!=','Cancelado')->whereNotNull('a.dataagendamento')->count();
        $dashboard->totalagendado = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where('s.descricao','=','Agendado')->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])->count();
        $dashboard->totalconcluido = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where('s.descricao','=','Concluído')->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])->count();
        $dashboard->totalprocesso = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where('s.descricao','=','Em Processo')->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])->count();
        $dashboard->totalpendente = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where('s.descricao','=','Pendente')->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])->count();
        $dashboard->totalpendente = $dashboard->totalpendente + DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where('s.descricao','=','Pendente')->whereNull(\DB::raw('a.dataagendamento'))->count();


        $dashadv = array();

        $advogados = DB::table('users as u')
            ->join('atendimentos as a', 'a.user_id', '=', 'u.id')
            ->join('situacaos as s', 's.id', '=', 'a.situacao_id')
            ->where('s.descricao','!=','Cancelado')
            ->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])
            ->groupBy('u.id','u.name','u.picture')
            ->select('u.id','u.name','u.picture',DB::raw('count(a.id) as total' ))
            ->orderBy('total', 'desc')
            ->get()->toArray();

        for ( $i = 0 ; $i <sizeof($advogados); $i++) {
            $dash = new DashboardAdvogados();
            $dash->name =  $advogados[$i]->name;
            $dash->id = $advogados[$i]->id;
            $dash->picture = $advogados[$i]->picture;
            $dash->total = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where([['s.descricao','!=','Cancelado'],['a.user_id', '=',$dash->id]])->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])->count();
            $dash->totalagendado = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where([['s.descricao','=','Agendado'],['a.user_id', '=',$dash->id]])->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])->count();
            $dash->totalconcluido = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where([['s.descricao','=','Concluído'],['a.user_id', '=',$dash->id]])->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])->count();
            $dash->totalprocesso = DB::table('atendimentos as a')->join('situacaos as s', 's.id', '=', 'a.situacao_id')->where([['s.descricao','=','Em Processo'],['a.user_id', '=',$dash->id]])->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])->count();
            $dashadv[$i] = $dash;
        }

        $atendimentoAdvogados = DB::table('atendimentos as a')
                    ->join('users as u', 'a.user_id', '=', 'u.id')
                    ->join('situacaos as s', 's.id', '=', 'a.situacao_id')
                    ->where('s.descricao','!=','Cancelado')
                    ->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])
                    ->groupBy('u.id','u.name','u.color')
                    ->select('u.id','u.name','u.color',DB::raw('count(a.id) as total' ))->get()->toArray();


        $atendimentoAdvogadosLabel = [];
        $atendimentoAdvogadosDados = [];
        $atendimentoAdvogadosColor = [];

        foreach ($atendimentoAdvogados as $att){

            array_push($atendimentoAdvogadosLabel,$att->name);
            array_push($atendimentoAdvogadosDados,$att->total);

            if(isset($att->color)){
                if($att->color == null){
                    $att->color = '#f6f6f6';
                }
            }
            array_push($atendimentoAdvogadosColor,$att->color);
        }

        $atendimentoTipoLabel = [];
        $atendimentoTipoDados = [];
        $atendimentoTipoColor = [];

        $atendimentoTipoOnline = DB::table('atendimentos as a')
            ->join('situacaos as s', 's.id', '=', 'a.situacao_id')
            ->where('s.descricao','!=','Cancelado')
            ->where('a.online','=','1')
            ->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])
            ->select(DB::raw('count(a.id) as online' ))->get()->toArray();

        $atendimentoTipoPresencial = DB::table('atendimentos as a')
            ->join('situacaos as s', 's.id', '=', 'a.situacao_id')
            ->where('s.descricao','!=','Cancelado')
            ->where('a.online','=','0')
            ->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])
            ->select(DB::raw('count(a.id) as presencial' ))->get()->toArray();


        foreach ($atendimentoTipoOnline as $online) {
            array_push($atendimentoTipoLabel,'Online');
            array_push($atendimentoTipoDados,$online->online);
            array_push($atendimentoTipoColor,'#'.$this->random_color());
        }
           foreach ($atendimentoTipoPresencial as $pres) {
               array_push($atendimentoTipoLabel,'Presencial');
               array_push($atendimentoTipoDados,$pres->presencial);
               array_push($atendimentoTipoColor,'#'.$this->random_color());
           }

        $atendimentoCidades = DB::table('atendimentos as a')
            ->join('cidades as c', 'c.id', '=', 'a.cidade_id')
            ->join('situacaos as s', 's.id', '=', 'a.situacao_id')
            ->where('s.descricao','!=','Cancelado')
            ->whereBetween(\DB::raw('DATE(a.dataagendamento)'),[$datainicial,$datafinal])
            ->groupBy('c.id','c.nome',)
            ->select('c.id','c.nome',DB::raw('count(a.id) as total' ))->get()->toArray();


        $atendimentoCidadesLabel = [];
        $atendimentoCidadesDados = [];
        $atendimentoCidadesColor = [];


        foreach ($atendimentoCidades as $cid){
            array_push($atendimentoCidadesLabel,$cid->nome);
            array_push($atendimentoCidadesDados,$cid->total);
            array_push($atendimentoCidadesColor,'#'.$this->random_color());

        }

        return view('dashboard',
            [
                'dashboardadv' => $dashadv,


                'dashboard'=>$dashboard,
                'atendimentoAdvogadosLabel' => json_encode($atendimentoAdvogadosLabel),
                'atendimentoAdvogadosDados' =>json_encode($atendimentoAdvogadosDados,JSON_NUMERIC_CHECK),
                'atendimentoAdvogadosColor' =>json_encode($atendimentoAdvogadosColor),

                'atendimentoCidadesLabel' => json_encode($atendimentoCidadesLabel),
                'atendimentoCidadesDados' =>json_encode($atendimentoCidadesDados,JSON_NUMERIC_CHECK),
                'atendimentoCidadesColor' =>json_encode($atendimentoCidadesColor),

                'atendimentoTipoLabel' => json_encode($atendimentoTipoLabel),
                'atendimentoTipoDados' =>json_encode($atendimentoTipoDados,JSON_NUMERIC_CHECK),
                'atendimentoTipoColor' =>json_encode($atendimentoTipoColor),
                'datainicial' => $datainicial,
                'datafinal' => $datafinal



            ]);
    }
    public function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    public function random_color() {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }


}
