<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Actua extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'nombre',
        'descripcion',
        'documentos',
        'fecha',
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
          
        });
    }
  // Relación con casos a través de la tabla pivote
  public function casos()
  {
      return $this->belongsToMany(Caso::class, 'caso_actuados','actua_id', 'caso_id')
                  ->withPivot('fecha') // campos adicionales en la tabla pivote
                  ->withTimestamps();
  }
}
