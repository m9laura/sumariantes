<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sancion_personas extends Model
{
    use HasFactory;
    protected $fillable = [
        'persona_id',
        'sancion_id',
        'fecha',
    ];

    // Relación con el modelo Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    // Relación con el modelo Sancion
    public function sancion()
    {
        return $this->belongsTo(Sancion::class);
    }

}
