<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Funcionario;
use Laravel\tipo_Ocorrencia;
use Laravel\datas_Especiais;
use Carbon\Carbon;

class DatasEspeciaisController extends Controller
{
    public function index(){
    	$funcionarios = Funcionario::all();
        $tipos_de_data = tipo_Ocorrencia::where('cargo_id', 9999)->pluck('descricao', 'id');
    	return view('datasespeciais', compact('funcionarios', 'tipos_de_data'));
    }

    public function funcionarioDatasEspeciais($funcionarioId){
    	$funcionario = Funcionario::findOrFail($funcionarioId);
        $tipos_de_data = tipo_Ocorrencia::where('cargo_id', 9999)->pluck('descricao', 'id');

        foreach ($funcionario->datas_especiais as $data_especial) {
            $data_especial->data = Carbon::parse($data_especial->data)->format('d/m/Y');
        }

    	return view('datasfuncionario', compact('funcionario', 'tipos_de_data'));
    }

    public function insertDataEspecial($funcionarioId, Request $data){        
        $this->validate($data, [
            'funcionarioId' => 'required',
            'data_tipo' => 'required',
            'data' => 'date_format:d/m/Y',
        ]);

        $data->data = Carbon::createFromFormat('d/m/Y',$data->data);

        try 
        {  
            datas_Especiais::create([
                'data' => $data->data,
                'fk_tipo_ocorrencia' => $data->data_tipo,
                'fk_funcionario' => $funcionarioId,
            ]);
        }
        catch (Exception $e)
        {
            echo 'Exceção', $e->getMessage(), '\n';
            die();
        }

        return redirect('/datasespeciais/' . $funcionarioId);
    }

    public function insertDataEspecialTodos(Request $data){        
        $this->validate($data, [
            'data_tipo' => 'required',
            'data' => 'date_format:d/m/Y',
        ]);

        $funcionarios = Funcionario::all();
        $data->data = Carbon::createFromFormat('d/m/Y',$data->data);

        try 
        {  
            foreach ($funcionarios as $funcionario) {
                datas_Especiais::create([
                    'data' => $data->data,
                    'fk_tipo_ocorrencia' => $data->data_tipo,
                    'fk_funcionario' => $funcionario->id,
                ]);
            }
        }
        catch (Exception $e)
        {
            echo 'Exceção', $e->getMessage(), '\n';
            die();
        }

        return redirect('/datasespeciais/');
    }

    public function deleteDataEspecial($dataEspecialId){
        try 
        {
            datas_Especiais::destroy($dataEspecialId);
        }
        catch (Exception $e) 
        {
            echo 'Exceção', $e->getMessage(), '\n';
            die();
        }

        return 0;
    }
}
