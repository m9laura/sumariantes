<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class caso_actuado extends Model
{
    use HasFactory;
    protected $table = 'caso_actuados'; // Nombre de la tabla

    protected $fillable = [
        'caso_id', 
        'actua_id', 
        'fecha'
    ];
  // Definición de relaciones
  public function caso()
  {
      return $this->belongsTo(Caso::class, 'caso_id'); // Asegúrate de que 'caso_id' sea el nombre correcto
  }

  public function actua()
  {
      return $this->belongsTo(Actua::class, 'actua_id'); // Asegúrate de que 'actua_id' sea el nombre correcto
  }

}
