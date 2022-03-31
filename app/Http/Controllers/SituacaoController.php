<?php

namespace App\Http\Controllers;

use App\Situacao;
use Illuminate\Http\Request;

class SituacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Situacao $model)
    {
        return view('situacao.index', ['situacoes' => $model->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('situacao.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Situacao $model)
    {
        $model->create($request->all());

        return redirect()->route('situacao.index')->withStatus(__('Situação Criada'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Situacao  $situacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Situacao $situacao)
    {
        return view('situacao.show', compact('situacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Situacao  $situacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Situacao $situacao)
    {
        $situacao->update($request->all());

        return redirect()->route('situacao.index')->withStatus(__('Situação Atualizada.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Situacao  $situacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Situacao $situacao)
    {

    }

    public function show(Situacao $situacao ){
        return view('situacao.show',['situacao' => $situacao]);


    }
}
