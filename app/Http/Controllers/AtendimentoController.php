<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\Atuacao;
use App\Cidade;
use App\Necessidade;
use App\Sexo;
use App\Situacao;
use App\TipoAtendimento;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Date;
use function PHPUnit\Framework\isNull;

class AtendimentoController extends Controller
{


//    public function __construct()
//    {
//        $this->authorizeResource(Atendimento::class);
//    }


    public function index( Request $request, Atendimento $atendimentos ,Situacao $situacoes, Cidade $cidades)    {


        //$this->authorize('manage-items', User::class);

        $datainicial = date('Y-m-d', strtotime('01-01-2022'));;
        $datafinal = Carbon::now();
        $cidadeid = $request->input('cidadeid');
//        if(!empty(auth()->user()->cidade_id) ){
//            $cidadeid = auth()->user()->cidade_id;

//       }
        $situacaoid = $request->input('situacaoid');
        $userid = $request->input('userid');


        $advogados = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->get();
        $situacao = DB::table('situacaos')->where('descricao','=','Cancelado')->get()->first();
        $atendimentos = Atendimento::where('situacao_id', '!=', $situacao->id);

        $situacoes = Situacao::where('descricao','!=','Cancelado')->get();


        $queryA = Atendimento::query();
        $queryA->where('situacao_id', '!=', $situacao->id);
        if($cidadeid >0){
            $queryA->where('cidade_id','=',$cidadeid);
        }
        if($situacaoid >0){
            $queryA->where('situacao_id','=',$situacaoid);
        }
        if($userid >0){
            $queryA->where('user_id','=',$userid);
        }

        $queryA->orderByDesc('created_at',);
        $atendimentos = $queryA->get();





        return view('atendimentos.index', ['atendimentos' => $atendimentos,
            'situacoes'=>$situacoes,
            'advogados'=>$advogados->all(),
            'cidades'=> $cidades->all(),
            'datainicial' => $datainicial,
            'datafinal' => $datafinal,
            'cidadeid' => $cidadeid,
            'userid' => $userid,
            'situacaoid' => $situacaoid]);

    }

    public function create(Atendimento $atendimento, Sexo $sexo, Necessidade $necessidade, Situacao $situacoes, Atuacao $atuacao,User $advogado, Cidade $cidade, TipoAtendimento $tipoatendimento){
        $atendimento = new Atendimento();
        $atendimento->datacadastro = now();
        $atendimento->dataagendamento = now();

        $atendimento->cidade_id = auth()->user()->cidade_id;
        $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->get();
        return view('atendimentos.show',[
            'atendimento' => $atendimento,
            'sexos' => $sexo->all(),
            'necessidades' => $necessidade->all(),
            'atuacoes' => $atuacao->all(),
            'situacoes' => $situacoes->all(),
            'advogados' => $advogado,
            'cidades' => $cidade->all(),
            'tipoatendimento' => $tipoatendimento->all()
        ]);
    }

    public function store(Request $request,Atendimento $atendimento, Sexo $sexo, Necessidade $necessidade, Situacao $situacoes, Atuacao $atuacao,User $advogado, Cidade $cidade){

        $atendimento = new Atendimento($request->all());
        $atendimento->created_by = auth()->user()->id;

        if($request->filled('dataagendamento')){
                $situacao =  Situacao::where('descricao','=','Agendado')->first();
                $atendimento->situacao_id = $situacao->id;

                $advogadoId = $request->input('user_id');
                $dataHora = $request->input('dataagendamento');
                $dataHora = str_replace('T', ' ', $dataHora);


                $verifica = Atendimento::where('user_id','=',$advogadoId)->where('dataagendamento','=' ,$dataHora)->get()->first();

                if(!empty($verifica)){
                    return redirect()->back()->withInput()->withErrors(['errors' => 'Já existe um atendimento agendado para '.$verifica->user->name.' em '. date_format(new \DateTime($verifica->dataagendamento),'d-m-y H:i').'. Cliente '.$verifica->nome.'.']);return redirect()->back()->withErrors(['errors' => 'Já existe um atendimento agendado para '.$verifica->user->name.' em '. date_format(new \DateTime($verifica->dataagendamento),'d-m-y H:i').'. Cliente '.$verifica->nome.'.']);
                }


        }


        $atendimento->save();

        return redirect()->route('atendimentos.index',[ 'atendimento' => $atendimento,
            'sexos' => $sexo->all(),
            'necessidades' => $necessidade->all(),
            'atuacoes' => $atuacao->all(),
            'situacoes' => $situacoes->all(),
            'advogados' => $advogado,
            'cidades' => $cidade->all()])->withStatus(__('Atendimento Criado!'));
    }

    public function show(Atendimento $atendimento, Sexo $sexo, Necessidade $necessidade, Situacao $situacoes, Atuacao $atuacao,User $advogado, Cidade $cidade, TipoAtendimento $tipoAtendimento){

        $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->get();
        $criador = User::find($atendimento->created_by);
        $atendimento->criadopor = $criador->name;

        return view('atendimentos.show',[
            'atendimento' => $atendimento,
            'sexos' => $sexo->all(),
            'necessidades' => $necessidade->all(),
            'atuacoes' => $atuacao->all(),
            'situacoes' => $situacoes->all(),
            'advogados' => $advogado,
            'cidades' => $cidade->all(),
            'tipoatendimento' => $tipoAtendimento->all(),

        ]);
    }

    public function showByCalendar(Request $request, Atendimento $atendimento, Sexo $sexo, Necessidade $necessidade, Situacao $situacoes, Atuacao $atuacao,User $advogado, Cidade $cidade, TipoAtendimento $tipoAtendimento){

        $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->get();
        $id = $request->input('atendimento_id_');
        $id = str_replace('> ','',$id);
        $atendimento = Atendimento::find($id);

        return view('atendimentos.show',[
            'atendimento' => $atendimento,
            'sexos' => $sexo->all(),
            'necessidades' => $necessidade->all(),
            'atuacoes' => $atuacao->all(),
            'situacoes' => $situacoes->all(),
            'advogados' => $advogado,
            'cidades' => $cidade->all(),
            'tipoatendimento' => $tipoAtendimento->all(),
        ]);
    }

    public function edit(Atendimento $atendimento){

    }

    public function update(Request $request, Atendimento $atendimento)
    {





        $advogadoId = $request->input('user_id');
        $dataHora = $request->input('dataagendamento');
        $dataHora = str_replace('T', ' ', $dataHora);
        $atendimentoId = $request->input('id');

        $verifica = Atendimento::where('user_id','=',$advogadoId)->where('dataagendamento','=' ,$dataHora)->where('id','!=',$atendimentoId)->get()->first();

        if(empty($verifica)){
            $atendimento->updated_by = auth()->user()->id;
            $atendimento->update($request->all());


            if($atendimento->situacao->descricao == 'Pendente'){
                if($request->filled('dataagendamento')){
                    $situacao =  Situacao::where('descricao','=','Agendado')->first();
                    $atendimento->situacao_id = $situacao->id;
                }
            }

            if ($request->has('isonline')) {
                $atendimento->online = 1;
                $atendimento->cidade_id = null;
            }
            else {
                $atendimento->online = 0;
            }


            if ($request->has('isretorno')) {

                $atendimento->retorno = 1;


            }
            else {
                $atendimento->retorno = 0;
            }
            $atendimento->save();
            return redirect()->route('atendimentos.index')->withStatus(__('Atualizado com sucesso!'));
        }else{
            return redirect()->back()->withErrors(['errors' => 'Já existe um atendimento agendado para '.$verifica->user->name.' em '. date_format(new \DateTime($verifica->dataagendamento),'d-m-y H:i').'. Cliente '.$verifica->nome.'.']);
        }








    }

    public function destroy(Atendimento $atendimento){

        $situacao = DB::table('situacaos')->where('descricao','=','Cancelado')->get()->first();
        $atendimento->situacao_id = $situacao->id;
        $atendimento->deleted_by = auth()->user()->id;
        $atendimento->save();
        return redirect()->route('atendimentos.index')->withErrors(__('Atendimento Excluido.'));
    }

    public function zap(Request $request){

        try {

            $data = $request->all();
            $dados_formatados = [

                'necessidade_id' => isset($data['necessidadeid']) ? $data['necessidadeid'] : null,
                'situacao_id' => 1,
                'tipoatendimento_id' =>1,
                'atuacao_id' => isset($data['atuacaoid']) ? $data['atuacaoid'] : null,
                'cidade_id' => isset($data['cidadeid']) ? $data['cidadeid'] : null,
                'nome' => isset($data['nome']) ? $data['nome'] : null,
                'whats' => isset($data['whats']) ? $data['whats'] : null,
                'idade' => isset($data['idade']) ? $data['idade'] : null,
                'anoscontribuicao' => isset($data['anos']) ? $data['anos'] : null,
                'datacadastro' => Carbon::now()


            ];

            if(isset($data['online'])){
                if($data['online'] == 1 || $data['online'] == true){
                    $dados_formatados['online'] = 1;
                }else{
                    $dados_formatados['online'] = 0;
                }

            }


            //return json_encode([$dados_formatados,$data]);
            Atendimento::create($dados_formatados);
            return response("Atendimento criado com sucesso!", 200);

        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }


    }
    public function showByCalendarEvent(Request $request, Atendimento $atendimento, Sexo $sexo, Necessidade $necessidade, Situacao $situacoes, Atuacao $atuacao,User $advogado, Cidade $cidade ,TipoAtendimento $tipoAtendimento){

        $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->get();
        $id = $request->input('atendimento_id_');
        $id = str_replace('> ','',$id);
        $atendimento = Atendimento::find($id);

        $situacoes = Situacao::where('descricao','!=','Agendado')->where('descricao','!=','Pendente')->where('descricao','!=','Cancelado')->get();

        return view('atendimentos.advogado',[
            'atendimento' => $atendimento,
            'sexos' => $sexo->all(),
            'necessidades' => $necessidade->all(),
            'atuacoes' => $atuacao->all(),
            'situacoes' => $situacoes,
            'advogados' => $advogado,
            'cidades' => $cidade->all(),
            'tipoatendimento' => $tipoAtendimento->all(),
        ]);
    }

    public function updateByAdvogado (Request $request, Atendimento  $atendimento){


        $atendimento = Atendimento::find($request->input('id'));
        $atendimento->situacao_id = $request->input('situacao_id');
        $atendimento->save();
        return redirect()->back()->withStatus(__('Atendimento Atualizado.'));


    }





    public function getAtendimentoAnterior($data){
        $atendimentoAnterior = DB::table('atendimentos')
            ->join('situacaos','situacaos.id','=','atendimentos.situacao_id')
            ->where('situacaos.descricao','=','Agendado')
            ->where('atendimentos.dataagendamento','<',$data)
            ->orderBy('atendimentos.dataagendamento','DESC')
            ->select('atendimentos.*')->get()->first();



        return $atendimentoAnterior;

    }
    public function getProximoAtendimento($data){
        $proximoAtendimento = DB::table('atendimentos')
            ->join('situacaos','situacaos.id','=','atendimentos.situacao_id')
            ->where('situacaos.descricao','=','Agendado')
            ->where('atendimentos.dataagendamento','>',$data)
            ->orderBy('atendimentos.dataagendamento','DESC')
            ->select('atendimentos.*')->get()->first();

        return $proximoAtendimento;

    }

}
