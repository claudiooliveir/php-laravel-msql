<?php

// Define o namespace onde o controller está localizado
// No Laravel todos os controllers ficam normalmente dentro de App\Http\Controllers
namespace App\Http\Controllers;

// Importa a classe Controller base do Laravel
// Todos os controllers geralmente herdam dela
use App\Http\Controllers\Controller;

// Declaração da classe do controller
// Esse controller será responsável por executar alguma lógica relacionada ao teste
class TestController extends Controller
{
    // Método chamado "test"
    // Ele recebe dois parâmetros da rota da URL ($p1 e $p2)
    // O "int" antes das variáveis indica que os valores devem ser números inteiros
    public function test(int $P1, int $P2)
    {
        // Retorna uma mensagem mostrando os valores recebidos
        // e também o resultado da soma entre eles
        //return "A soma de $p1 + $p2 é: " . ($p1 + $p2);

        //return view("site.test", ['P1' => $P1, 'P2' => $P2]); // Passando os valores para a view usando um array associativo

          return view ('site.test', compact ('P1', 'P2')); // O método compact é uma forma mais simples de passar variáveis para a view

        //return view('site.test')->with('P1', $P1)->with('P2', $P2); // Passando os valores para a view usando o método with

    }
}
