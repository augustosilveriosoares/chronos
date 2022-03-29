<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('situacao_id')->references('id')->on('situacaos');
            $table->foreignId('sexo_id')->references('id')->on('sexos');
            $table->foreignId('atuacao_id')->references('id')->on('atuacaos');
            $table->foreignId('necessidade_id')->references('id')->on('necessidades');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->foreignId('cidade_id')->nullable()->references('id')->on('cidades');
            $table->string('nome')->nullable();;
            $table->string('idade')->nullable();;
            $table->string('anoscontribuicao')->nullable();;
            $table->string('whats')->nullable();;
            $table->string('email')->nullable();;
            $table->string('mensagem')->nullable();
            $table->date('datacadastro')->nullable();
            $table->dateTime('dataagendamento')->nullable();
            $table->boolean('online')->nullable();
            $table->boolean('retorno')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atendimentos');
    }
}
