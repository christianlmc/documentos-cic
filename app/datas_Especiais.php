<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Laravel\tipo_Ocorrencia;
use Laravel\Funcionario;

class datas_Especiais extends Model
{
    public $table = "datas_especiais";
    public $timestamps = false;

    protected $fillable = [
		'data',		// Data em que há feriado ou ponto facultativo
		'fk_tipo_ocorrencia',	// Chave estrangeira responsável por armazenar a ocorrência referente a data
		'fk_funcionario',	// Chave estrangeira responsável por armazenar o funcionário que possui a ocorrencia
	];

	public function tipo_ocorrencia()
	{
		return $this->hasOne(tipo_Ocorrencia::class, 'id', 'fk_tipo_ocorrencia');
	}

	public function funcionario()
	{
		return $this->hasOne(Funcionario::class, 'id', 'fk_funcionario');
	}
}
