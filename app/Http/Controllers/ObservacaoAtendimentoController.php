<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\ObservacaoAtendimento;
use Illuminate\Http\Request;

class ObservacaoAtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Atendimento $atendimento)

    {
        if ($request->filled('atendimento_id')) {

           $atendimento = Atendimento::find($request->input('atendimento_id'));

           $obs = new ObservacaoAtendimento();
            $obs->descricao = $request->input('descricao');
            $obs->atendimento_id = $request->input('atendimento_id');
            $obs->user_id = $request->input('user_id');
            $obs->data = now();

            $atendimento->observacoes()->save($obs);



        }
        return redirect()->back()->withStatus(__('Observação registrada.'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ObservacaoAtendimento  $observacaoAtendimento
     * @return \Illuminate\Http\Response
     */
    public function show(ObservacaoAtendimento $observacaoAtendimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ObservacaoAtendimento  $observacaoAtendimento
     * @return \Illuminate\Http\Response
     */
    public function edit(ObservacaoAtendimento $observacaoAtendimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ObservacaoAtendimento  $observacaoAtendimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObservacaoAtendimento $observacaoAtendimento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ObservacaoAtendimento  $observacaoAtendimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObservacaoAtendimento $observacaoAtendimento)
    {
        //
    }
}
