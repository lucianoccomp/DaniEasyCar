<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Rota index
Route::get('/index', 'IndexController@index');

//Rotas Clientes
Route::get('/cliente/novo', 'ClienteController@create');
Route::get('/clientes','ClienteController@index');
Route::post('/cliente/cadastrar','ClienteController@store');
Route::get('/cliente/{cliente}','ClienteController@show');
Route::get('/cliente/{cliente}/edit','ClienteController@edit');
Route::PUT('/cliente/editar/{cliente}','ClienteController@update');
Route::delete('/cliente/{cliente}','ClienteController@destroy');


//Rotas Veículos
Route::get('/veiculos','VeiculoController@index');
Route::get('/veiculo/novo', 'VeiculoController@create');
Route::post('/veiculo/cadastrar','VeiculoController@store');
Route::get('/veiculo/{veiculo}','VeiculoController@show');
Route::get('/veiculo/{veiculo}/edit','VeiculoController@edit');
Route::PUT('/veiculo/editar/{veiculo}','VeiculoController@update');
Route::delete('/veiculo/{veiculo}','VeiculoController@destroy');


//Rotas fornecedores
Route::get('/fornecedores','FornecedorController@index');
Route::get('/fornecedor/novo', 'FornecedorController@create');
Route::post('/fornecedor/cadastrar','FornecedorController@store');
Route::get('/fornecedor/{fornecedor}','FornecedorController@show');
Route::get('/fornecedor/{fornecedor}/edit','FornecedorController@edit');
Route::PUT('/fornecedor/editar/{fornecedor}','FornecedorController@update');
Route::delete('/fornecedor/{fornecedor}','FornecedorController@destroy');

    
//Rotas despesas
Route::get('/despesas','DespesaController@index');
Route::get('/despesa/nova', 'DespesaController@create');
Route::get('/despesa/{despesa}','DespesaController@show');
Route::post('/despesa/cadastrar','DespesaController@store');
Route::get('/despesa/{despesa}/edit','DespesaController@edit');
Route::PUT('/despesa/editar/{despesa}','DespesaController@update');
Route::delete('/despesa/{despesa}','DespesaController@destroy');


//Rotas receitas
Route::get('/receitas','ReceitaController@index');
Route::get('/receita/nova', 'ReceitaController@create');
Route::get('/receita/{receita}','ReceitaController@show');
Route::post('/receita/cadastrar','ReceitaController@store');
Route::get('/receita/{receita}/edit','ReceitaController@edit');
Route::PUT('/receita/editar/{receita}','ReceitaController@update');
Route::delete('/receita/{receita}','ReceitaController@destroy');


//Rotas FluxoCaixa
Route::get('/fluxocaixa','FluxoCaixaController@index');


//Rotas Locações
Route::get('/locacoes','LocacaoController@index');
Route::get('/locacao/nova', 'LocacaoController@create');
Route::get('/locacao/{locacao}','LocacaoController@show');
Route::post('/locacao/cadastrar','LocacaoController@store');
Route::get('/locacao/{locacao}/edit','LocacaoController@edit');
Route::PUT('/locacao/editar/{locacao}','LocacaoController@update');
Route::delete('/locacao/{locacao}','LocacaoController@destroy');

