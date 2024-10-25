<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personas';

    protected $fillable = [
        'nombre',
        'apellidop',
        'apellidom',
        'ci',
        'extension',
        'expedido',
        'genero',
        'nacionalidad',
        'fnacimiento',
        'whatsapp',
        'institucion',
        'unidad',
        'tipo_persona_id',
        'cargo',
        'domicilioreal',
        'domiciliolegal',
        'domicilioconvencional',
        'gmail',
        'sancion_id',
        'fecha',
        'foto'
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
        });
    }
    public function usuarios()
    {
        return $this->hasMany(usuario::class, 'idp', 'id'); // Asegúrate de que 'idp' sea la clave foránea correcta
    }
    public function registros()
    {
        return $this->hasMany(registro::class, 'idp', 'id'); // Asegúrate de que 'idp' sea la clave foránea correcta
    }
    // Relación con tipo_personas a través de la tabla pivote persona_tipo_personas
    ///tipo_personas ///persona_tipo_persona
    public function tipoPersonas()
    {
        return $this->belongsToMany(Tipo_Persona::class, 'persona_tipo_personas', 'persona_id', 'tipo_persona_id')
        ->withPivot('fecha')// Incluimos el campo 'fecha' de la tabla pivote
        ->withTimestamps();
        // Asegúrate de especificar la tabla pivote
    }  
    public function casos() // Relación con casos a través de la tabla pivote caso_personas
    {
        return $this->belongsToMany(Caso::class, 'caso_personas')
            ->withPivot('fecha')// Incluimos el campo 'fecha' de la tabla pivote
            ->withTimestamps();
    }
        // Relación directa con la tabla sancion
    public function sancion()
    {
        return $this->belongsTo(Sancion::class);
    }

    // Relación de muchos a muchos con sanciones // Relación con SancionPersona
    public function sancionpersonas()
    {
        return $this->belongsToMany(Sancion::class, 'sancionpersonas', 'persona_id', 'sancion_id')
            ->withPivot('fecha'); // Incluye la columna 'fecha' de la tabla pivote
    }
//Si necesitas acceder a las sanciones de manera más sencilla, puedes crear un método en 
 //el modelo Persona que retorne solo los IDs de las sanciones. Esto hará que tu vista sea más clara:
    public function getSancionIds()
    {
        return $this->sancionpersonas->pluck('id')->toArray();
    }



}
