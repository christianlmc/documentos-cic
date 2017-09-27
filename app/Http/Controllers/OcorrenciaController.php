<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Funcionario;
use Laravel\Ocorrencia;
use Laravel\tipo_Ocorrencia;
use Laravel\datas_Especiais;
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
            'data_fim' => 'date_format:d/m/Y|after_or_equal:data_inicio',
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
        
        $firstday = $data->data_inicio;
        $lastday = $data->data_fim;

        while ($firstday->lte($lastday)) {
            try{
                datas_Especiais::create([
                    'data' => $firstday,
                    'fk_tipo_ocorrencia' => $data->tipo_ocorrencia,
                    'fk_funcionario' => $data->funcionario_id,
                ]);
            }
            catch (Exception $e)
            {
                echo 'Exceção', $e->getMessage(), '\n';
                die();
            }
            $firstday->addDay();
        }
    	return redirect('/ocorrencias/' . $data->funcionario_id);
    }

    public function deleteOcorrencia($id){
    	$ocorrencia = Ocorrencia::find($id);

        $firstday = Carbon::createFromFormat('Y-m-d', $ocorrencia->data_inicio);
        $lastday = Carbon::createFromFormat('Y-m-d', $ocorrencia->data_fim);

        while ($firstday->lte($lastday)) {
            try{
                $data = datas_Especiais::whereDate('data', $firstday->toDateString())
                        ->where('fk_funcionario', $ocorrencia->fk_funcionario)->delete();

            }
            catch (Exception $e)
            {
                echo 'Exceção', $e->getMessage(), '\n';
                die();
            }

            $firstday->addDay();
        }

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
