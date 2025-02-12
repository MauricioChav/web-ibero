<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'user_id', 'name','description','due_date', 'status', 'project_id'
	];

	public function projects(){
		return $this->belongsTo(Project::class, 'proyect_id', 'id');
	}
}
