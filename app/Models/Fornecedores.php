<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    use HasFactory;
    protected $table = 'fornecedores';
    // O atributo $table é usado para especificar o nome da tabela associada a este modelo.
    // Se a tabela tiver um nome diferente do plural do nome do modelo, você pode definir o nome da tabela usando este atributo.

    protected $fillable = [
        'nome',
        'cnpj',
        'endereco',
        'telefone',
        'email',
    ];
    // O atributo $fillable é usado para definir quais campos podem ser preenchidos em massa (mass assignment).
    // Isso é importante para proteger contra atribuição em massa indesejada, onde um usuário mal-intencionado pode tentar preencher campos que não deveriam ser preenchidos.


}
