<?php

namespace Database\Seeders;

use App\Models\persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{

    public function run()
    {
        $persona = [
            ['nombre' => 'rudy', 'apellidop' => 'mauricio', 'apellidom' => 'montaño', 'ci' => '83177485', 'extension' => null, 'expedido' => 'lp', 'genero' => 1, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59179112050, 'institucion' => 'GAMEA', 'tipo_persona_id' => 2, 'unidad' => 'sistemas', 'cargo' => 'pasante', 'domicilioreal' => 'elalto', 'domiciliolegal' => 'mi otra casa', 'domicilioconvencional' => 'mi casa', 'gmail' => 'prueba@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],
            ['nombre' => 'maribel', 'apellidop' => 'vargas', 'apellidom' => 'laura', 'ci' => '83277485', 'extension' => null, 'expedido' => 'lp', 'genero' => 0, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59169836120, 'institucion' => 'GAMEA', 'tipo_persona_id' => 1, 'unidad' => 'sistemas', 'cargo' => 'pasante', 'domicilioreal' => 'elalto', 'domiciliolegal' => 'mi otra casa', 'domicilioconvencional' => 'mi casa', 'gmail' => 'prueba@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],
            ['nombre' => 'yerk', 'apellidop' => 'mauricio', 'apellidom' => 'montaño', 'ci' => '83737485', 'extension' => null, 'expedido' => 'lp', 'genero' => 1, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59165144038, 'institucion' => 'GAMEA', 'tipo_persona_id' => 6, 'unidad' => 'sistemas', 'cargo' => 'pasante', 'domicilioreal' => 'elalto', 'domiciliolegal' => 'mi otra casa', 'domicilioconvencional' => 'mi casa', 'gmail' => 'prueba@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],
            ['nombre' => 'daysi', 'apellidop' => 'llusco', 'apellidom' => 'candia', 'ci' => '83747485', 'extension' => null, 'expedido' => 'lp', 'genero' => 0, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59167157486, 'institucion' => 'GAMEA', 'tipo_persona_id' => 3, 'unidad' => 'sistemas', 'cargo' => 'pasante', 'domicilioreal' => 'elalto', 'domiciliolegal' => 'mi otra casa', 'domicilioconvencional' => 'mi casa', 'gmail' => 'prueba@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],
            ['nombre' => 'mendel', 'apellidop' => 'maldonado', 'apellidom' => 'nina', 'ci' => '83577485', 'extension' => null, 'expedido' => 'lp', 'genero' => 1, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59167056203, 'institucion' => 'GAMEA', 'tipo_persona_id' => 3, 'unidad' => 'sistemas', 'cargo' => 'pasante', 'domicilioreal' => 'elalto', 'domiciliolegal' => 'mi otra casa', 'domicilioconvencional' => 'mi casa', 'gmail' => 'prueba@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],
            ['nombre' => 'liz', 'apellidop' => 'layme', 'apellidom' => null, 'ci' => '8377485', 'extension' => null, 'expedido' => 'lp', 'genero' => 0, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59175243174, 'institucion' => 'GAMEA', 'tipo_persona_id' => 3, 'unidad' => 'sistemas', 'cargo' => 'pasante', 'domicilioreal' => 'elalto', 'domiciliolegal' => 'mi otra casa', 'domicioconvencilional' => 'mi casa', 'gmail' => 'prueba@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],
            // Ejemplo 1
            ['nombre' => 'andrea', 'apellidop' => 'rojas', 'apellidom' => 'perez', 'ci' => '843675485', 'extension' => null, 'expedido' => 'cb', 'genero' => 0, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59168473921, 'institucion' => 'GAMEA', 'tipo_persona_id' => 4, 'unidad' => 'finanzas', 'cargo' => 'asistente', 'domicilioreal' => 'cochabamba', 'domiciliolegal' => 'av. villazón', 'domicilioconvencional' => 'cochabamba', 'gmail' => 'andrea.rojas@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],
            // Ejemplo 2
            ['nombre' => 'julio', 'apellidop' => 'ramirez', 'apellidom' => 'gomez', 'ci' => '842437485', 'extension' => null, 'expedido' => 'sc', 'genero' => 1, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59169123456, 'institucion' => 'GAMEA', 'tipo_persona_id' => 5, 'unidad' => 'recursos humanos', 'cargo' => 'analista', 'domicilioreal' => 'santa cruz', 'domiciliolegal' => 'c. montero', 'domicilioconvencional' => 'santa cruz', 'gmail' => 'julio.ramirez@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],
            // Ejemplo 3
            ['nombre' => 'claudia', 'apellidop' => 'rodriguez', 'apellidom' => 'quiroz', 'ci' => '84757485', 'extension' => null, 'expedido' => 'lp', 'genero' => 0, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59176123456, 'institucion' => 'GAMEA', 'tipo_persona_id' => 1, 'unidad' => 'marketing', 'cargo' => 'coordinadora', 'domicilioreal' => 'la paz', 'domiciliolegal' => 'av. arce', 'domicilioconvencional' => 'la paz', 'gmail' => 'claudia.rodriguez@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],
            // Nuevos ejemplos añadidos correctamente
            ['nombre' => 'carla', 'apellidop' => 'quiroga', 'apellidom' => 'perez', 'ci' => '835544785', 'extension' => null, 'expedido' => 'lp', 'genero' => 0, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59178912345, 'institucion' => 'GAMEA', 'tipo_persona_id' => 3, 'unidad' => 'recursos humanos', 'cargo' => 'jefe', 'domicilioreal' => 'elalto', 'domiciliolegal' => 'zona norte', 'domicilioconvencional' => 'mi oficina', 'gmail' => 'carla.quiroga@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],

            ['nombre' => 'juan', 'apellidop' => 'fernandez', 'apellidom' => 'gomez', 'ci' => '837747485', 'extension' => null, 'expedido' => 'cb', 'genero' => 1, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59171234567, 'institucion' => 'GAMEA', 'tipo_persona_id' => 4, 'unidad' => 'finanzas', 'cargo' => 'analista', 'domicilioreal' => 'cochabamba', 'domiciliolegal' => 'av. libertad', 'domicilioconvencional' => 'mi casa', 'gmail' => 'juan.fernandez@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],

            ['nombre' => 'sandra', 'apellidop' => 'rodriguez', 'apellidom' => 'lopez', 'ci' => '893677485', 'extension' => null, 'expedido' => 'lp', 'genero' => 0, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59178956789, 'institucion' => 'GAMEA', 'tipo_persona_id' => 2, 'unidad' => 'proyectos', 'cargo' => 'coordinadora', 'domicilioreal' => 'la paz', 'domiciliolegal' => 'calle 21', 'domicilioconvencional' => 'mi casa', 'gmail' => 'sandra.rodriguez@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],

            ['nombre' => 'luis', 'apellidop' => 'mendoza', 'apellidom' => 'tapia', 'ci' => '832472485', 'extension' => null, 'expedido' => 'or', 'genero' => 1, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59167654321, 'institucion' => 'GAMEA', 'tipo_persona_id' => 5, 'unidad' => 'sistemas', 'cargo' => 'técnico', 'domicilioreal' => 'oruro', 'domiciliolegal' => 'calle bolívar', 'domicilioconvencional' => 'mi oficina', 'gmail' => 'luis.mendoza@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui'],

            ['nombre' => 'valeria', 'apellidop' => 'flores', 'apellidom' => 'aguilar', 'ci' => '839837485', 'extension' => null, 'expedido' => 'sc', 'genero' => 0, 'nacionalidad' => 'bolivia', 'fnacimiento' => now(), 'whatsapp' => 59173456789, 'institucion' => 'GAMEA', 'tipo_persona_id' => 1, 'unidad' => 'marketing', 'cargo' => 'asistente', 'domicilioreal' => 'santa cruz', 'domiciliolegal' => 'av. monseñor', 'domicilioconvencional' => 'mi casa', 'gmail' => 'valeria.flores@gmail.com', 'fecha' => now(), 'foto' => 'fotoaqui']
        ];


        persona::insert($persona);
    }
}
