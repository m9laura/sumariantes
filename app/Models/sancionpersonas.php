<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sancionpersonas extends Model
{
    use HasFactory;
    protected $table = 'sancionpersonas'; // Asegúrate de que el nombre de la tabla coincida

    protected $fillable = [
        'persona_id',
        'sancion_id',
        'fecha',
    ];
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function sancion()
    {
        return $this->belongsTo(Sancion::class, 'sancion_id');
    }

}
