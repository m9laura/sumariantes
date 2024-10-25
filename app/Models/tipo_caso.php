<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipo_caso extends Model
{
    use HasFactory, SoftDeletes; //colocar el softdeletes borrado logico
    protected $table = 'tipo_casos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'gravedad',
        'fecha',
        'caso_id' // Agregamos caso_id para la relación con el modelo caso
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
            $model->estado = 1; // Establece el estado por defecto como activo

        });
    }
    // Relación con el modelo Caso
    public function casos()
    {
        return $this->hasMany(Caso::class, 'tipo_caso_id'); // Asegúrate de que 'tipo_caso_id' sea el nombre correcto del campo
    }
    // Relación con el modelo Caso
   

}
