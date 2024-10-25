<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona_tipo_persona extends Model
{
    protected $table = 'persona_tipo_personas'; // Nombre de la tabla

    protected $fillable = [
        'persona_id',
        'tipo_persona_id',
        'fecha', // Si tienes un campo para fecha
        // 'user_id' si se requiere para almacenar el ID del usuario que creó el registro
    ];
  
       // Relación con Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    // Relación con Tipo_Persona
    public function tipoPersona()
    {
        return $this->belongsTo(Tipo_Persona::class, 'tipo_persona_id');
    }
  
}
