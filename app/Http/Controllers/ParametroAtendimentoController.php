<?php

namespace App\Http\Controllers;

use App\ParametroAtendimento;
use Illuminate\Http\Request;

class ParametroAtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parametroAtendimento = ParametroAtendimento::find(1);


        return view('parametro.show',[
            'parametro' => $parametroAtendimento




        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParametroAtendimento  $parametroAtendimento
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $parametroAtendimento = ParametroAtendimento::all()->first;
        dd('chego show');

        return view('parametro.show',[
            'parametro' => $parametroAtendimento




        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParametroAtendimento  $parametroAtendimento
     * @return \Illuminate\Http\Response
     */
    public function edit(ParametroAtendimento $parametroAtendimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParametroAtendimento  $parametroAtendimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParametroAtendimento $parametroAtendimento)
    {
        $parametroAtendimento = ParametroAtendimento::find($request->input('id'));
        $parametroAtendimento->tempo = $request->input('tempo');
        $parametroAtendimento->save();
        return view('parametro.show',[
            'parametro' => $parametroAtendimento




        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParametroAtendimento  $parametroAtendimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParametroAtendimento $parametroAtendimento)
    {
        //
    }
}
