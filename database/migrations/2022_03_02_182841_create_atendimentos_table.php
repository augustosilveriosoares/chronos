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
            $table->foreignId('necessidade_id')->nullable()->references('id')->on('necessidades');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->foreignId('cidade_id')->nullable()->references('id')->on('cidades');
            $table->foreignId('tipoatendimento_id')->nullable()->references('id')->on('tipo_atendimentos');
            $table->string('nome')->nullable();;
            $table->string('nome')->nullable();;
            $table->string('whats')->nullable();;
            $table->string('email')->nullable();;
            $table->string('mensagem')->nullable();
            $table->date('datacadastro')->nullable();
            $table->dateTime('dataagendamento')->nullable();
            $table->boolean('online')->nullable();
            $table->boolean('retorno')->nullable();
            $table->foreignId('created_by')->nullable()->references('id')->on('users');
            $table->foreignId('deleted_by')->nullable()->references('id')->on('users');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users');

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
