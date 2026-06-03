<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjusteProdutosFiliais extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Criação da tabela filiais
        Schema::create('filiais', function (Blueprint $table) {
            $table->id();
            $table->string('filial', 50);
            $table->timestamps();
        });

        // Tabela pivot produtos_filiais
        Schema::create('produtos_filiais', function (Blueprint $table) {
            $table->id();

            $table->foreignId('filial_id')
                ->constrained('filiais')
                ->onDelete('cascade');

            $table->foreignId('produto_id')
                ->constrained('produtos')
                ->onDelete('cascade');

            $table->decimal('preco_venda', 8, 2); // colunas do tipo double vem como decimal no Laravel
            $table->integer('estoque_minimo');
            $table->integer('estoque_atual');
            $table->integer('estoque_maximo');

            $table->timestamps();
        });

        // Remover colunas da tabela produtos que agora estão na tabela produtos_filiais
        Schema::table('produtos', function (Blueprint $table) {

            if (Schema::hasColumn('produtos', 'preco_venda')) {
                $table->dropColumn('preco_venda');
            } else {
                // Se a coluna não existir, podemos lançar uma exceção ou apenas ignorar
                // throw new Exception("Coluna 'preco_venda' não encontrada na tabela 'produtos'.");
            }

            if (Schema::hasColumn('produtos', 'estoque_minimo')) {
                $table->dropColumn('estoque_minimo');
            } else {
                // Se a coluna não existir, podemos lançar uma exceção ou apenas ignorar
                // throw new Exception("Coluna 'estoque_minimo' não encontrada na tabela 'produtos'.");
            }

            if (Schema::hasColumn('produtos', 'estoque_atual')) {
                $table->dropColumn('estoque_atual');
            } else {
                // Se a coluna não existir, podemos lançar uma exceção ou apenas ignorar
                // throw new Exception("Coluna 'estoque_atual' não encontrada na tabela 'produtos'.");
            }

            if (Schema::hasColumn('produtos', 'estoque_maximo')) {
                $table->dropColumn('estoque_maximo');
            } else {
                // Se a coluna não existir, podemos lançar uma exceção ou apenas ignorar
                // throw new Exception("Coluna 'estoque_maximo' não encontrada na tabela 'produtos'.");
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Adicionar novamente as colunas na tabela produtos 
        Schema::table('produtos', function (Blueprint $table) {
            $table->decimal('preco_venda', 8, 2)->nullable();
            $table->integer('estoque_minimo')->nullable();
            $table->integer('estoque_atual')->nullable();
            $table->integer('estoque_maximo')->nullable();
        });

        Schema::dropIfExists('produtos_filiais');
        Schema::dropIfExists('filiais');
    }
}
