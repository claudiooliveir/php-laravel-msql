<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_contatos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 50);
             $table->string('telefone', 20);
            $table->string('email', 80);
            $table->integer('motivo_contato');
            $table->text('mensagem', 200);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_contatos'); // método dropIfExists é mais seguro, pois verifica se a tabela existe antes de tentar removê-la, evitando erros caso a tabela já tenha sido removida ou nunca tenha sido criada.
        // Schema::drop('site_contatos'); // alternativa para remover a tabela, mas o método dropIfExists é mais seguro, pois verifica se a tabela existe antes de tentar removê-la, evitando erros caso a tabela já tenha sido removida ou nunca tenha sido criada.

    }
}
