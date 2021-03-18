<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
		'name','description','final_date', 'hex'
	];

	public function tasks(){
		return $this->hasMany(Task::class);
	}

	/*
	hasMany (Uno a muchos) Modelo con múltiples registros vinculados
	belongsTo (Pertenece a) Modelo que debe vincularse a su padre
	hasOne (Uno a uno)
	belongsToMany(Muchos a muchos)

	*/
}
