<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Funcionario;
use Laravel\Ocorrencia;
use Laravel\tipo_Ocorrencia;
use Carbon\Carbon;

class OcorrenciaController extends Controller
{
    public function index($id){

    	$funcionario = Funcionario::find($id);
    	$ocorrencias = Ocorrencia::where('fk_funcionario', $funcionario->id)->get();
    	$tipo_Ocorrencia = tipo_Ocorrencia::where('cargo_id', $funcionario->fk_cargo)->pluck('descricao', 'id');

        foreach ($ocorrencias as $ocorrencia) {
            $ocorrencia->data_inicio = Carbon::parse($ocorrencia->data_inicio)->format('d/m/Y');
            $ocorrencia->data_fim = Carbon::parse($ocorrencia->data_fim)->format('d/m/Y');
        }

    	return view ('ocorrencia', compact('ocorrencias', 'funcionario', 'tipo_Ocorrencia'));
    }

    public function insertOcorrencia(Request $data){
    	$this->validate($data, [
            'funcionario_id' => 'required',
            'tipo_ocorrencia' => 'required',
            'data_inicio' => 'date_format:d/m/Y',
            'data_fim' => 'date_format:d/m/Y',
        ]);

        $data->data_inicio = Carbon::createFromFormat('d/m/Y',$data->data_inicio);
        $data->data_fim = Carbon::createFromFormat('d/m/Y',$data->data_fim);

        try 
        {  
            Ocorrencia::create([
            	'data_inicio' => $data->data_inicio,
                'data_fim' => $data->data_fim,
                'fk_tipo_ocorrencia' => $data->tipo_ocorrencia,
                'fk_funcionario' => $data->funcionario_id,
            ]);
        }
        catch (Exception $e)
        {
        	echo 'Exceção', $e->getMessage(), '\n';
            die();
        }

    	return redirect('/ocorrencias/' . $data->funcionario_id);
    }

    public function deleteOcorrencia($id){
    	try 
        {
            Ocorrencia::destroy($id);
        }
        catch (Exception $e) 
        {
            echo 'Exceção', $e->getMessage(), '\n';
            die();
        }

        return 0;
    }
}
