<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Laravel\Lotacao;
use Laravel\Cargo;

/* Modelo responsável por armazenar os funcionários ativos do departamento. Este modelo é usado para centralizar as informações no momento da geração dos documentos.
 */

class Funcionario extends Model
{
	public $timestamps = false;

    protected $fillable = [
		'nome',  			// Nome do funcionário
		'matricula_fub',	// Matrícula do funcionário na FUB. Pode armazenar também a matrícula do estagiário na UnB
		'matricula_siape',	// Matrícula do funcionário no SIAPE
		'periodo_inicio',	// Data de ingresso do funcionário na UnB
		'periodo_fim',		// Data do desligamento do funcionário da UnB. Pode armazenar também a data prevista de fim do estágio
		'is_supervisor',	// Booleano identificando um supervisor
		'hora_inicio',		// Horário de entrada no trabalho
		'hora_fim',			// Horário de saída do trabalho
		'cargo_especifico',
		'fk_lotacao',		// Chave estrangeira que armazena a lotação do funcionário
		'fk_cargo',			// Chave estrangeira que armazena o cargo do funcionário
		'fk_supervisor',	// Chave estrangeira que armazena o supervisor direto do funcionário
	];

	public function lotacao()
	{
		return $this->hasOne(Lotacao::class,'id', 'fk_lotacao');
	}

	public function cargo()
	{
		return $this->hasOne(Cargo::class,'id', 'fk_cargo');
	}

	public function supervisor()
	{
		return $this->hasOne(Funcionario::class,'id','fk_supervisor');
	}

	public function datas_especiais()
	{
		return $this->hasMany(datas_Especiais::class, 'fk_funcionario', 'id');
	}

}
