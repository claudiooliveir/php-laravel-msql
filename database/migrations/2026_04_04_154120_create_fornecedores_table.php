<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores');
        // Schema::drop('fornecedores'); // alternativa para remover a tabela, mas o método dropIfExists é mais seguro, pois verifica se a tabela existe antes de tentar removê-la, evitando erros caso a tabela já tenha sido removida ou nunca tenha sido criada.
    }
}
