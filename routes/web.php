<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/funcionario', 'FuncionarioController@index');
	Route::post('/funcionario', 'FuncionarioController@insertFuncionario');
	Route::get('/funcionario/{id}', 'FuncionarioController@getFuncionario');
	Route::put('/funcionario/{id}', 'FuncionarioController@updateFuncionario');
	Route::delete('/funcionario/{id}', 'FuncionarioController@deleteFuncionario');


	Route::get('/ocorrencias/{id}', 'OcorrenciaController@index');
	Route::post('/ocorrencias', 'OcorrenciaController@insertOcorrencia');
	Route::delete('/ocorrencias/{id}', 'OcorrenciaController@deleteOcorrencia');


	Route::get('/imprimefolha', 'ImprimeController@index');

	Route::post('/imprimefolha/estagiario/{id}', 'ImprimeController@folhaEstagiario');
	Route::get('/imprimefolha/estagiario/supervisor/{id}', 'ImprimeController@folhaEstagiariosPorSupervisor');
	Route::get('/imprimefolha/estagiario/lotacao/{id}', 'ImprimeController@folhaEstagiariosPorLotacao');

	Route::get('/imprimefolha/servidor/{id}', 'ImprimeController@folhaServidor');
	Route::get('/imprimefolha/servidor/supervisor/{id}', 'ImprimeController@folhaServidoresPorSupervisor');
	Route::get('/imprimefolha/servidor/lotacao/{id}', 'ImprimeController@folhaServidoresPorLotacao');

	Route::get('/imprimefolha/cargo/{id}', 'ImprimeController@folhaPorCargo');

	Route::get('/datasespeciais', 'DatasEspeciaisController@index');
	Route::get('/datasespeciais/{userId}', 'DatasEspeciaisController@funcionarioDatasEspeciais');
	Route::post('/datasespeciais/{userId}', 'DatasEspeciaisController@insertDataEspecial');
	Route::post('/datasespeciais', 'DatasEspeciaisController@insertDataEspecialTodos');
	Route::delete('/datasespeciais/{dataId}', 'DatasEspeciaisController@deleteDataEspecial');

	Route::get('/folhateste', 'ImprimeController@folhaTeste');
});