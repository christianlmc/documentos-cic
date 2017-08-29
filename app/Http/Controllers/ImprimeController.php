<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Funcionario;
use Carbon\Carbon;
use Laravel\Ocorrencia;
use Laravel\Lotacao;
use Laravel\Cargo;
use Laravel\datas_Especiais;

class ImprimeController extends Controller
{
    public function index(){
    	$funcionarios = Funcionario::all();
        $supervisores = Funcionario::where('is_supervisor', 1)->pluck('nome', 'id');
        $lotacoes = Lotacao::all()->pluck('descricao', 'id');
        $cargos = Cargo::whereNotIn('id', [9999])->get();
        
        $meses = [];

        for($month = Carbon::now()->subMonths(5); $month != Carbon::now()->addMonths(2);$month->addMonth())
            $meses[$month->copy()->format('m-Y')] = $month->copy()->format('m/Y');

        foreach ($cargos as $cargo) {
            $cargo->descricao = $cargo->descricao.' - '.$cargo->carga_horaria.'Hrs';
        }
        $cargos = $cargos->pluck('descricao', 'id');
        
    	return view('imprimefolha', compact('funcionarios', 'supervisores', 'lotacoes', 'cargos', 'meses'));
    }

    public function folhaEstagiario($id, $mes){
        $estagiarios[] = Funcionario::findOrFail($id);

        return $this->viewFolhaEstagiario($estagiarios, $mes);        
    }

    public function folhaEstagiariosPorSupervisor($supervisor){
        $estagiarios = Funcionario::where([
            ['fk_supervisor', $supervisor],
            ['fk_cargo', 2]
        ])->get();

        return $this->viewFolhaEstagiario($estagiarios);

    }

    public function folhaEstagiariosPorLotacao($lotacao){
        $estagiarios = Funcionario::where([
            ['fk_lotacao', $lotacao],
            ['fk_cargo', 2]
        ])->get();

        return $this->viewFolhaEstagiario($estagiarios);
    }

    public function folhaServidor($id, $mes){
        $servidores[] = Funcionario::findOrFail($id);

        return $this->viewFolhaServidor($servidores, $mes);        
    }

    public function folhaServidoresPorSupervisor($supervisor){
        $servidores = Funcionario::where([
            ['fk_supervisor', $supervisor],
            ['fk_cargo', 3]
        ])->get();

        return $this->viewFolhaServidor($servidores);        
    }

    public function folhaServidoresPorLotacao($lotacao){
        $servidores = Funcionario::where([
            ['fk_lotacao', $lotacao],
            ['fk_cargo', 3]
        ])->get();

        return $this->viewFolhaServidor($servidores);        
    }

    public function folhaPorCargo($cargo, $mes){
        $funcionarios = Funcionario::where('fk_cargo', $cargo)->get();
        switch ($cargo) {
            case '1':
                # code...
                break;
            case '2':
                return $this->viewFolhaEstagiario($funcionarios, $mes);
                break;
            case '3':
                return $this->viewFolhaServidor($funcionarios, $mes);
                break;
            
            default:
                # code...
                break;
        }        
    }

    private function viewFolhaEstagiario($estagiarios, $mes_referencia){
        
        setlocale(LC_TIME, 'pt_BR');
        $mes = Carbon::createFromFormat('m-Y', $mes_referencia);

        foreach ($estagiarios as $estagiario) {
            $estagiario->periodo_inicio = Carbon::parse($estagiario->periodo_inicio)->format('d/m/Y');
            $estagiario->periodo_fim = Carbon::parse($estagiario->periodo_fim)->format('d/m/Y');
            $estagiario->hora_inicio = Carbon::parse($estagiario->hora_inicio)->format('H');
            $estagiario->hora_fim = Carbon::parse($estagiario->hora_fim)->format('H');

            $ocorrencias = Ocorrencia::where('fk_funcionario', $estagiario->id)->get();

            foreach ($ocorrencias as $ocorrencia) {
                $ocorrencia->data_inicio = Carbon::parse($ocorrencia->data_inicio)->format('d/m/Y');
                $ocorrencia->data_fim = Carbon::parse($ocorrencia->data_fim)->format('d/m/Y');
            }

            $datas_estagiario = datas_Especiais::where('fk_funcionario', $estagiario->id)
                                                ->whereMonth('data', $mes->month)->get();

            $firstday = $mes->startOfMonth()->endOfDay()->copy();
            $lastday = $mes->endOfMonth()->copy();
            
            $dias = [];
            while ($firstday->lte($lastday)) {
                $dias[] = $firstday->copy();
                $firstday->addDay();
            }

            foreach ($dias as $dia) {
                $data_especial = $datas_estagiario->where('data', $dia->format('Y-m-d'))
                                ->where('fk_funcionario', $estagiario->id)->all();
                if($data_especial){
                    $dia->hour = 0;
                }
            }

            $estagiario->dias = $dias;
            $estagiario->ocorrencias = $ocorrencias;

        }

        $mes = $mes->formatLocalized('%B/%Y');

        return view('folhaestagiario', compact('estagiarios', 'mes', 'dias'));
    }

    private function viewFolhaServidor($servidores, $mes_referencia){
        setlocale(LC_TIME, 'pt_BR');
        $mes = Carbon::createFromFormat('m-Y', $mes_referencia);

        foreach ($servidores as $servidor) {
            $ocorrencias = Ocorrencia::where('fk_funcionario', $servidor->id)->get();

            foreach ($ocorrencias as $ocorrencia) {
                $ocorrencia->data_inicio = Carbon::parse($ocorrencia->data_inicio)->format('d/m/Y');
                $ocorrencia->data_fim = Carbon::parse($ocorrencia->data_fim)->format('d/m/Y');
            }
            $datas_servidor = datas_Especiais::where('fk_funcionario', $servidor->id)
                                                    ->whereMonth('data', $mes->month)->get();
            $firstday = $mes->startOfMonth()->endOfDay()->copy();
            $lastday = $mes->endOfMonth()->copy();
            
            $dias = [];
            while ($firstday->lte($lastday)) {
                 $dias[] = $firstday->copy();
                 $firstday->addDay();
            }


            foreach ($dias as $dia) {
                $data_especial = $datas_servidor->where('data', $dia->format('Y-m-d'))
                                ->where('fk_funcionario', $servidor->id)->all();
                if($data_especial){
                    $dia->hour = 0;
                }
            }

            $servidor->ocorrencias = $ocorrencias;
            $servidor->dias = $dias;
        }

        $mes = $mes->formatLocalized('%B/%Y');

        return view('folhaservidor', compact('servidores', 'dias', 'mes'));
    }

    public function folhaTeste(){
        // $servidores = Funcionario::where([
        //     ['fk_cargo', 3]
        // ])->get();

        $servidores[] = Funcionario::find(1);
        setlocale(LC_TIME, 'pt_BR');
        $mes = new Carbon('last month');

        $mes = $mes->formatLocalized('%B/%Y');

        $firstday = new Carbon('first day of last month');
        $lastday = new Carbon('last day of last month');
        
        $dias = [];
        while ($firstday->lte($lastday)) {
             $dias[] = $firstday->copy();
             $firstday->addDay();
        }
        return view('folhatestes', compact('servidores', 'dias', 'mes'));

    }
}
