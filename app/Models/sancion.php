<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class sancion extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'fecha'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
            $model->estado = 1;

        });
    }

    // Cambia esta relación
    public function sancionpersonas()
    {
        return $this->belongsToMany(Persona::class, 'sancionpersonas', 'sancion_id', 'persona_id')
        ->withPivot('fecha'); // Incluye la columna 'fecha' de la tabla pivote
    
    }
    
}