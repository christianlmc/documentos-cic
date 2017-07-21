<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Funcionario;
use Laravel\Lotacao;
use Laravel\Cargo;
use Carbon\Carbon;

class FuncionarioController extends Controller
{
    public function index()
    {
    	$funcionarios = Funcionario::all();
        $supervisores = Funcionario::where('is_supervisor', '<>', 0)->pluck('nome', 'id');
        $supervisores->put(0, "Sem supervisor");

        $lotacoes = Lotacao::pluck('descricao', 'id');
        $cargos = Cargo::all();

        foreach ($cargos as $cargo) {
            $cargo->descricao = $cargo->descricao.' - '.$cargo->carga_horaria.'Hrs';
        }
        $cargos = $cargos->pluck('descricao', 'id');

    	return view('funcionario', compact('funcionarios', 'lotacoes', 'cargos', 'supervisores'));
    }

    public function getFuncionario($id) {
        $funcionario = Funcionario::find($id);
        $funcionario->periodo_inicio = Carbon::parse($funcionario->periodo_inicio)->format('d/m/Y');
        $funcionario->periodo_fim = Carbon::parse($funcionario->periodo_fim)->format('d/m/Y');
        return($funcionario);
    }

    public function validateFuncionario($funcionario){
        $this->validate($funcionario, [
            'cargo' => 'required',
        ]);
        switch ($funcionario->cargo) {
            case 1:
                $this->validate($funcionario, [
                    'nome' => 'required|regex:/^[\pL\s\-]+$/u',
                    'matricula_fub' => 'required|unique:funcionarios|numeric',
                    'matricula_siape' => 'required|unique:funcionarios|numeric',
                    'periodo_inicio' => 'required|date_format:d/m/Y',
                    'periodo_fim' => 'required|date_format:d/m/Y|after:periodo_inicio',
                    'hora_inicio' => 'required|date_format:H:i',
                    'hora_fim' => 'required|date_format:H:i|after:hora_inicio',
                    'lotacao' => 'required',
                    'is_supervisor' => 'required',
                    'supervisor' => 'required',
                ]);
                break;
            case 2:
                $this->validate($funcionario, [
                    'nome' => 'required|regex:/^[\pL\s\-]+$/u',
                    'periodo_inicio' => 'required|date_format:d/m/Y',
                    'periodo_fim' => 'required|date_format:d/m/Y|after:periodo_inicio',
                    'hora_inicio' => 'required|date_format:H:i',
                    'hora_fim' => 'required|date_format:H:i|after:hora_inicio',
                    'lotacao' => 'required',
                    'is_supervisor' => 'required',
                    'supervisor' => 'required',
                ]);
                break;
            case 3:
                $this->validate($funcionario, [
                    'nome' => 'required|regex:/^[\pL\s\-]+$/u',
                    'matricula_fub' => 'nullable|unique:funcionarios|numeric',
                    'matricula_siape' => 'nullable|unique:funcionarios|numeric',
                    'lotacao' => 'required',
                    'is_supervisor' => 'required',
                    'supervisor' => 'required',
                ]);
                break;
            default:
                return redirect('/funcionario')->with('warning', 'O cargo não existe na base de dados');
        }
    }

    public function validateUpdateFuncionario($funcionario){
        $this->validate($funcionario, [
            'cargo' => 'required',
        ]);
        switch ($funcionario->cargo) {
            case 1:
                $this->validate($funcionario, [
                    'nome' => 'required|regex:/^[\pL\s\-]+$/u',
                    'matricula_fub' => 'required|numeric',
                    'matricula_siape' => 'required|numeric',
                    'periodo_inicio' => 'required|date_format:d/m/Y',
                    'periodo_fim' => 'required|date_format:d/m/Y|after:periodo_inicio',
                    'hora_inicio' => 'required|date_format:H:i',
                    'hora_fim' => 'required|date_format:H:i|after:hora_inicio',
                    'lotacao' => 'required',
                    'is_supervisor' => 'required',
                    'supervisor' => 'required',
                ]);
                break;
            case 2:
                $this->validate($funcionario, [
                    'nome' => 'required|regex:/^[\pL\s\-]+$/u',
                    'periodo_inicio' => 'required|date_format:d/m/Y',
                    'periodo_fim' => 'required|date_format:d/m/Y|after:periodo_inicio',
                    'hora_inicio' => 'required|date_format:H:i',
                    'hora_fim' => 'required|date_format:H:i|after:hora_inicio',
                    'lotacao' => 'required',
                    'is_supervisor' => 'required',
                    'supervisor' => 'required',
                ]);
                break;
            case 3:
                $this->validate($funcionario, [
                    'nome' => 'required|regex:/^[\pL\s\-]+$/u',
                    'matricula_fub' => 'nullable|numeric',
                    'matricula_siape' => 'nullable|numeric',
                    'lotacao' => 'required',
                    'is_supervisor' => 'required',
                    'supervisor' => 'required',
                ]);
                break;
            default:
                return redirect('/funcionario')->with('warning', 'O cargo não existe na base de dados');
        }
    }

    public function insertFuncionario(Request $data){
        $this->validateFuncionario($data);      

        if($data->supervisor == 0){
            $data->supervisor = NULL;
        }

        if ($data->cargo != 3){
            $data->periodo_inicio = Carbon::createFromFormat('d/m/Y',$data->periodo_inicio);
            $data->periodo_fim = Carbon::createFromFormat('d/m/Y',$data->periodo_fim);
        }

        try{  
            Funcionario::create([
                'nome' => $data->nome,
                'matricula_fub' => $data->matricula_fub,
                'matricula_siape' => $data->matricula_siape,
                'periodo_inicio' => $data->periodo_inicio,
                'periodo_fim' => $data->periodo_fim,
                'hora_inicio' => $data->hora_inicio,
                'hora_fim' => $data->hora_fim,
                'is_supervisor' => $data->is_supervisor,
                'fk_lotacao' => $data->lotacao,
                'fk_cargo' => $data->cargo,
                'fk_supervisor' => $data->supervisor,
            ]);
        } 
        catch (Exception $e){
            echo 'Exceção', $e->getMessage(), '\n';
            die();
        }

        return redirect('/funcionario');
    }

    public function updateFuncionario (Request $data, $id){
        $this->validateUpdateFuncionario($data);

        $funcionario = Funcionario::find($id);

        if($data->supervisor == 0)
        {
            $data->supervisor = NULL;
        }

        if($funcionario->fk_cargo == 2){
            $data->periodo_inicio = Carbon::createFromFormat('d/m/Y',$data->periodo_inicio);
            $data->periodo_fim = Carbon::createFromFormat('d/m/Y',$data->periodo_fim);
        }
        
        try 
        {
            $funcionario->update([
                'nome' => $data->nome,
                'matricula_fub' => $data->matricula_fub,
                'matricula_siape' => $data->matricula_siape,
                'periodo_inicio' => $data->periodo_inicio,
                'periodo_fim' => $data->periodo_fim,
                'hora_inicio' => $data->hora_inicio,
                'hora_fim' => $data->hora_fim,
                'is_supervisor' => $data->is_supervisor,
                'fk_lotacao' => $data->lotacao,
                'fk_cargo' => $data->cargo,
                'fk_supervisor' => $data->supervisor,
            ]);
        }
        catch (Exception $e) 
        {
            echo 'Exceção', $e->getMessage(), '\n';
            die();
        }
        return redirect('/funcionario');

    }

    public function deleteFuncionario($id) {

        try 
        {
            $func = Funcionario::find($id);
            Funcionario::destroy($id);
        }
        catch (Exception $e) 
        {
            echo 'Exceção', $e->getMessage(), '\n';
            die();
        }

        return $func;
    }
}
