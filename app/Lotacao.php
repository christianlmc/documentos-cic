<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Laravel\Funcionario;

/* Modelo responsável por armazenar os departamentos disponíveis para ocupação pelos funcionários
 */

class Lotacao extends Model
{
    public $table= "lotacao";
	public $timestamps = false;

	protected $fillable = [
		'descricao', 'sigla', 'codigo', 		// Nome do departamento a que o funcionário pertence
	];

	public function funcionarios()
	{
		return $this->hasMany(Funcionario::class,'id' ,'fk_lotacao');
	}
}
