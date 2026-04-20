<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CalcController;


Route::get('/', [PrincipalController::class, 'principal'])->name('site.index');

// ->name('site.index') é para nomear a rota, para facilitar a manutenção do código, caso haja mudança na url, não precisará alterar o código, apenas a rota.

Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');

Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');

Route::get('/login', function(){return "Login";})->name('site.login');

Route::get('/test/{P1}/{P2}', [TestController::class, 'test'])->name('test');

Route::get('/calc/{a1}/{a2}', [CalcController::class, 'calc'])->name('calc');

Route::prefix('/app')->group(function(){

// prefix é para agrupar as rotas, para facilitar a manutenção do código, caso haja mudança na url, não precisará alterar o código, apenas a rota.

Route::get('/login', function(){return "Login";});

// como a rota já tem o prefixo, não precisa colocar o /app/login, apenas /login, pois o prefixo já está definido.

Route::get('/clientes', function(){return "Clientes";})->name('app.clientes');
Route::get('/fornecedores', function(){return 'Fornecedores';})->name('app.fornecedores');
Route::get('/produtos', function(){return 'Produtos';})->name('app.produtos');
});


Route::fallback(function() {
    echo 'A rota acessada não existe! <a href="'.route('site.index').'">clique aqui</a> para ir a página inicial';
});
