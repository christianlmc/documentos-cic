<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

/* Modelo responsável por armazenar os cargos disponíveis para atribuição
 * Exemplo de preenchimento:
 * 		- Professor
 *		- Servidor
 *		- Estagiário
 */

class Cargo extends Model
{
	public $timestamps = false;
	
	protected $fillable = [
		'descricao',  		// Nome do cargo
		'carga_horaria',	// Carga horária do cargo descrita em horas
	];
}
