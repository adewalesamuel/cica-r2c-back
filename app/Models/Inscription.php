<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscription extends Model
{
    use HasFactory, SoftDeletes;
            
	public function pack()
	{
		return $this->belongsTo(Pack::class); 
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class); 
	}

}