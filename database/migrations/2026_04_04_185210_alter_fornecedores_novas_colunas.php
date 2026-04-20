<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFornecedoresNovasColunas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() // Método para adicionar novas colunas à tabela fornecedores
    {
        // Adicionando novas colunas à tabela fornecedores existente
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('uf', 2);
            $table->string('email', 100);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Removendo as colunas adicionadasno metodo up caso seja necessário reverter a migração
         Schema::table('fornecedores', function (Blueprint $table) {
           //$table->dropColumn('uf', 2);
           // $table->dropColumn('email', 100);
            $table->dropColumn(['uf', 'email']); // é possível remover múltiplas colunas em uma única chamada ao método dropColumn, passando um array com os nomes das colunas a serem removidas.
        });

    }
}
