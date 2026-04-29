<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string("unidade", 5); // Exemplo: "kg", "g", "l", "ml", "un"
            $table->string("descrição", 30); // Exemplo: "Quilograma", "Grama", "Litro", "Mililitro", "Unidade"
            $table->timestamps();
        });

        // Adicionar relacionamentos entre produtos
        Schema::table("produtos", function (Blueprint $table){
            $table->unsignedBigInteger('unidade_id'); // Adiciona a coluna unidade_id como chave estrangeira para a tabela unidades
            $table->foreign('unidade_id')->references('id')->on('unidades'); // contraint unidade_id referencia a id da tabela unidades, garantindo a integridade referencial entre as tabelas produtos e unidades, ou seja, cada produto deve estar associado a uma unidade válida, e se uma unidade for deletada, os produtos associados a ela também serão afetados (dependendo da configuração de deleção em cascata)

        });
        // adicionar relacionamentos com a tabela produto_detalhes
        Schema::table("produto_detalhes", function (Blueprint $table){
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover relacionamentos entre produtos
        Schema::table("produtos", function (Blueprint $table){
            $table->dropForeign('produtos_unidade_id_foreign'); // nome da constraint gerada automaticamente pelo Laravel, seguindo o padrão: {nome_da_tabela}_{nome_da_coluna}_foreign
            $table->dropColumn('unidade_id');
            // por que remover o relacionamento antes de deletar a tabela unidades?
            //Porque a tabela produtos tem uma chave estrangeira que referencia a tabela unidades, e se tentarmos deletar a tabela unidades sem remover primeiro o relacionamento, o banco de dados irá impedir a deleção devido à violação da integridade referencial.
            //Portanto, é necessário remover o relacionamento (chave estrangeira) antes de deletar a tabela unidades para evitar erros e garantir que o banco de dados permaneça consistente.
        });

        // Remover relacionamentos com a tabela produto_detalhes
        Schema::table("produto_detalhes", function (Blueprint $table){
            $table->dropForeign('produto_detalhes_unidade_id_foreign'); // nome da constraint gerada automaticamente pelo Laravel, seguindo o padrão: {nome_da_tabela}_{nome_da_coluna}_foreign
            $table->dropColumn('unidade_id');
        });

        Schema::dropIfExists('unidades');
    }
}
