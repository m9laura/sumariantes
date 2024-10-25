<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class caso_personas extends Model
{
    use HasFactory;

protected $table = 'caso_personas'; // Asegúrate de que el nombre de la tabla sea correcto

protected $fillable = [
    'caso_id',
    'persona_id',
   // 'fecha', // Agrega cualquier otro campo adicional que tengas en la tabla pivote
];

// Definir la relación con el modelo Caso
public function caso()
{
    return $this->belongsTo(Caso::class, 'caso_id');
}

// Definir la relación con el modelo Persona
public function persona()
{
    return $this->belongsTo(Persona::class, 'persona_id');
}
}