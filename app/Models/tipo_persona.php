<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipo_persona extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'tipo_personas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        //'tipo_persona_id',//razon?
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
    // Define la relación con Persona
    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'persona_tipo_personas', 'tipo_persona_id', 'persona_id')
        ->withPivot('fecha')// Incluimos el campo 'fecha' de la tabla pivote
        ->withTimestamps();
          }

    public function mensajes()
    {
        return $this->belongsTo(mensaje::class);
    }
}
