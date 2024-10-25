<?php

namespace Database\Seeders;
use App\Models\caso;
use App\Models\tipo_mensaje;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();

        //PERMISOS DEL SEEDER
         $this->call(RoleSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(TipoMensajeSeeder::class);
         $this->call(TipoPersonaSeeder::class);
        // $this->call(PersonaSeeder::class);
         $this->call(SancionSeeder::class);
     //  $this->call(CasoSeeder::class);
        $this->call(ActuaSeeder::class);
        
        
    }
}
