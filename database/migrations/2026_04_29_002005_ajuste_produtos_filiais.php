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

            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_atual');
            $table->integer('estoque_maximo');

            $table->timestamps();
        });

        // Remover colunas da tabela produtos se existirem antes de criar a tabela produtos_filiais para evitar conflitos de dados e garantir que as informações de preço e estoque sejam gerenciadas exclusivamente na nova tabela produtos_filiais, permitindo uma estrutura de dados mais organizada e eficiente para lidar com múltiplas filiais e seus respectivos produtos.
        Schema::table('produtos', function (Blueprint $table) {

            if (Schema::hasColumn('produtos', 'preco_venda')) {
                $table->dropColumn('preco_venda');
            }

            if (Schema::hasColumn('produtos', 'estoque_minimo')) {
                $table->dropColumn('estoque_minimo');
            }

            if (Schema::hasColumn('produtos', 'estoque_atual')) {
                $table->dropColumn('estoque_atual');
            }

            if (Schema::hasColumn('produtos', 'estoque_maximo')) {
                $table->dropColumn('estoque_maximo');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Recriar colunas na tabela produtos
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
