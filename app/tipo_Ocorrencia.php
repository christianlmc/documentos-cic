<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cargo;

class tipo_Ocorrencia extends Model
{
	public $table = "tipo_ocorrencia"
    public $timestamps = false;

	protected $fillable = [
		'descricao',  	// Descrição da ocorrência
		'cargo_id',		// Chave estrangeira responsável por armazenar o tipo de cargo a que aquela ocorrência se refere
	];

	public function cargo()
	{
		return $this->hasOne(Cargo::class, 'id', 'cargo_id');
	}
}
