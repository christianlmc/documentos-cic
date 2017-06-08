<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Laravel\tipo_Ocorrencia;
use Laravel\Funcionario;

/* Modelo responsável por armazenar as ocorrência de cada funcionário. Os tipo de ocorrência possíveis são descritas no modelo tipo_Ocorrencia
 */

class Ocorrencia extends Model
{
    public $timestamps = false;

	protected $fillable = [
		'data_inicio',  		// Data de início da ocorrencia
		'data_fim',  			// Data de fim da ocorrencia
		'fk_tipo_ocorrencia',	// Chave estrangeira responsável por armazenar o tipo de ocorrência
		'fk_funcionario',		// Chave estrangeira responsável por armazenar o id do funcionário a quem aquela ocorrencia se refere
	];

	public function tipo_Ocorrencia()
	{
		return $this->hasOne(tipo_Ocorrencia::class, 'id', 'fk_tipo_ocorrencia');
	}

	public function funcionario()
	{
		return $this->hasOne(Funcionario::class,'id', 'fk_funcionario');
	}
}
