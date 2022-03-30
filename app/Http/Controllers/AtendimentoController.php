<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\Atuacao;
use App\Cidade;
use App\Necessidade;
use App\Sexo;
use App\Situacao;
use App\User;
use Illuminate\Http\Request;
use DB;

class AtendimentoController extends Controller
{


//    public function __construct()
//    {
//        $this->authorizeResource(Atendimento::class);
//    }


    public function index(Atendimento $atendimentos)    {

        $this->authorize('manage-items', User::class);

        $situacao = DB::table('situacaos')->where('descricao','=','Cancelado')->get()->first();
        $atendimentos = Atendimento::where('situacao_id', '!=', $situacao->id)->paginate(10);
        return view('atendimentos.index', ['atendimentos' => $atendimentos]);

    }

      public function create(Atendimento $atendimento, Sexo $sexo, Necessidade $necessidade, Situacao $situacoes, Atuacao $atuacao,User $advogado, Cidade $cidade){

        $atendimento = new Atendimento();
        $atendimento->datacadastro = now();
        $atendimento->dataagendamento = '';
        $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->get();
        return view('atendimentos.show',[
            'atendimento' => $atendimento,
            'sexos' => $sexo->all(),
            'necessidades' => $necessidade->all(),
            'atuacoes' => $atuacao->all(),
            'situacoes' => $situacoes->all(),
            'advogados' => $advogado,
            'cidades' => $cidade->all(),
        ]);
    }

    public function store(Request $request,Atendimento $atendimento, Sexo $sexo, Necessidade $necessidade, Situacao $situacoes, Atuacao $atuacao,User $advogado, Cidade $cidade){


        $atendimento->create($request->all());

        return redirect()->route('atendimentos.index',[ 'atendimento' => $atendimento,
            'sexos' => $sexo->all(),
            'necessidades' => $necessidade->all(),
            'atuacoes' => $atuacao->all(),
            'situacoes' => $situacoes->all(),
            'advogados' => $advogado,
            'cidades' => $cidade->all()])->withStatus(__('Atendimento Criado!'));
    }

    public function show(Atendimento $atendimento, Sexo $sexo, Necessidade $necessidade, Situacao $situacoes, Atuacao $atuacao,User $advogado, Cidade $cidade ){

        $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->get();

        return view('atendimentos.show',[
            'atendimento' => $atendimento,
            'sexos' => $sexo->all(),
            'necessidades' => $necessidade->all(),
            'atuacoes' => $atuacao->all(),
            'situacoes' => $situacoes->all(),
            'advogados' => $advogado,
            'cidades' => $cidade->all(),
        ]);
    }
    public function showByCalendar(Request $request, Atendimento $atendimento, Sexo $sexo, Necessidade $necessidade, Situacao $situacoes, Atuacao $atuacao,User $advogado, Cidade $cidade ){

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
        ]);
    }

    public function edit(Atendimento $atendimento){

    }

    public function update(Request $request, Atendimento $atendimento)
    {


        $atendimento->update($request->all());

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
    }


    public function destroy(Atendimento $atendimento){

        $situacao = DB::table('situacaos')->where('descricao','=','Cancelado')->get()->first();
        $atendimento->situacao_id = $situacao->id;
        $atendimento->save();
        return redirect()->route('atendimentos.index')->withErrors(__('Atendimento Excluido.'));
    }

    public function zap(Request $request){

        try {

            $data = $request->all();
            $dados_formatados = [
                'necessidade_id' => isset($data['necessidadeid']) ? $data['necessidadeid'] : null,
                'situacao_id' => isset($data['situacaoid']) ? $data['situacaoid'] : null,
                'atuacao_id' => isset($data['atuacaoid']) ? $data['atuacaoid'] : null,
                'cidade_id' => isset($data['cidadeid']) ? $data['cidadeid'] : null,
                'nome' => isset($data['nome']) ? $data['nome'] : null,
                'whats' => isset($data['whats']) ? $data['whats'] : null,
                'email' => isset($data['email']) ? $data['email'] : null,
                'idade' => isset($data['idade']) ? $data['idade'] : null,
                'anoscontribuicao' => isset($data['anoscontribuicao']) ? $data['anoscontribuicao'] : null
            ];

            if(isset($data['online']) && $data['online'] == true){
                $dados_formatados['online'] = true;
            }
            if(isset($data['presencial']) && $data['online'] == true){
                $dados_formatados['online'] = false;
            }

            //return json_encode([$dados_formatados,$data]);
            Atendimento::create($dados_formatados);
            return response("Atendimento criado com sucesso!", 200);

            return http_response_code(200);

        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }


    }

}
