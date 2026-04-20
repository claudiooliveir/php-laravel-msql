<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users'); // método dropIfExists é mais seguro, pois verifica se a tabela existe antes de tentar removê-la, evitando erros caso a tabela já tenha sido removida ou nunca tenha sido criada.
        // Schema::drop('users'); // alternativa para remover a tabela, mas o método dropIfExists é mais seguro, pois verifica se a tabela existe antes de tentar removê-la, evitando erros caso a tabela já tenha sido removida ou nunca tenha sido criada.
    }
}
