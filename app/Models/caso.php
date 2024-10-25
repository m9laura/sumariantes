<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\tipo_caso;

class caso extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'casos';

    protected $fillable = [
        'exp_adm',
        'registro_auxiliar',
        'registro_aux',
        'identificacion_caso',
        'instructivo',
        'mae',
        'apertura_inicial',
        'tipo_caso_id', // Clave foránea
        'resolucion_final',
        'recurso_revocatoria',
        'recurso_jerarquico',
        'ejecutoria',
        'antecedentes',
        'etapa',
        'estado_proceso',
        'fecha',
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
            $model->estado_proceso = 'todo listo';
        });
    }
    // Define otras relaciones si es necesario
    public function actuas()
    {
        return $this->belongsToMany(Actua::class, 'caso_actuados', 'caso_id', 'actua_id')
            ->withPivot('fecha') // Incluyendo campos adicionales de la tabla pivote
            ->withTimestamps(); // Para manejar marcas de tiempo en la tabla pivote
    }
    // Relación con tipo_caso
    public function tipoCaso()
    {
        return $this->belongsTo(tipo_caso::class, 'tipo_caso_id'); // Un caso pertenece a un tipo de caso
    }
    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'caso_personas')
            ->withPivot('fecha') // Incluimos el campo 'fecha' de la tabla pivote
            ->withTimestamps();
    }
}
