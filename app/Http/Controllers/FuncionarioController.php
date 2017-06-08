<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Funcionario;
use Laravel\Lotacao;
use Laravel\Cargo;

class FuncionarioController extends Controller
{
    public function index()
    {
    	$funcionarios = Funcionario::all();
    	$lotacoes = Lotacao::pluck('descricao', 'id');
    	$cargos = Cargo::all();
    	foreach ($cargos as $cargo) {
    		$cargo->descricao = $cargo->descricao.' - '.$cargo->carga_horaria.'Hrs';
    	}
    	$cargos = $cargos->pluck('descricao', 'id');
    	
    	return view('funcionario',compact('funcionarios','lotacoes','cargos'));
    }

    public function inserir(Request $data){
        $this->validate($data, [
            'nome' => 'required',
            'matricula_fub' => '',
            'matricula_siape' => '',
            'periodo_inicio' => 'date',
            'periodo_fim' => 'date',
            'hora_inicio' => 'numeric',
            'hora_fim' => 'numeric',
            'cargo' => 'required',
            'supervisor' => '',
        ]);
        dd($data->all());

    }
}
