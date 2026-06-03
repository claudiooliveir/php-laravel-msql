<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoDetalhesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_detalhes', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('produto_id'); // Chave estrangeira para a tabela produtos
            $table->float('comprimento', 8, 2);
            $table->float('largura', 8, 2);
            $table->float('altura', 8, 2);


            $table->foreign('produto_id')->references('id')->on('produtos'); // contraint
            // dessa forma adicionamos a contraint de chave estrangeira, garantindo a integridade referencial entre as tabelas
            // isso significa que cada registro em produtos_detalhes deve estar associado a um registro existente em produtos, e se um produto for deletado, os detalhes associados a ele também serão removidos (dependendo da configuração de deleção em cascata)

            $table->unique("produto_id"); // garantindo que cada produto tenha apenas um registro de detalhes associado a ele ou seja, uma relação um-para-um entre produtos e produtos_detalhes
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
        Schema::dropIfExists('produto_detalhe');
    }
}
