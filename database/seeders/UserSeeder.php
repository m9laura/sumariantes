<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // User::create([
        //     'name' =>'rudy',
        //     'email' =>'rudy@gmail.com',
        //     'password' => '123456789',
        //     'apellidopaterno' => 'mauricio',
        //     'apellidomaterno' => 'montaño',
        //     'ci' => '123456789',
        //     'expedito' => 'LP', // Ejemplo
        //     'estado' => true,
        //     'foto' => 'users/1yB1QSSvSc1HK3kYRDH6Fjt1Lejnrjcfqp9AVHWX.jpg', // Ejemplo
        //     'genero' => true, // Ejemplo
        //     'cargo' => 'Administrador', // Ejemplo
        //     'unidad' => 'Administración', // Ejemplo
        //     'fnacimiento' => '1999-11-22',
        //     'finicio' => '2024-04-30',
        //     'fsuspension' => null, // Ejemplo
        // ])->assignRole('administrador');

        User::create([
            'name' =>'moises',
            'email' =>'moises@gmail.com',
            'password' => '123456789',
            'apellidopaterno' => 'quellca',
            'apellidomaterno' => 'larrea',
            'ci' => '6135300',
            'expedito' => 'LP', // Ejemplo
            'estado' => true,
            'foto' => 'users/1yB1QSSvSc1HK3kYRDH6Fjt1Lejnrjcfqp9AVHWX.jpg', // Ejemplo
            'genero' => true, // Ejemplo
            'cargo' => 'pasante', // Ejemplo
            'unidad' => 'sistemas', // Ejemplo
            'fnacimiento' => '2000-09-28',
            'finicio' => '2024-08-14',
            'fsuspension' => null, // Ejemplo
        ])->assignRole('administrador');

         User::create([
             'name' =>'miguelina',
             'email' =>'miguelina@gmail.com',
             'password' => bcrypt('12345678'),
             'apellidopaterno' => 'Laura',
             'apellidomaterno' => 'Velarde',
             'ci' => '6921902',
             'expedito' => 'LP', // Ejemplo
             'estado' => true,
             'foto' => 'users/lauralaura.jpeg', // Ejemplo
             'genero' => true, // Ejemplo
             'cargo' => 'pasante', // Ejemplo
             'unidad' => 'sistemas', // Ejemplo
             'fnacimiento' => '1999-09-29',
             'finicio' => '2024-04-30',
             'fsuspension' => null, // Ejemplo
         ])->assignRole('administrador');
         
         User::create([
            'name' =>'blanca',
            'email' =>'blanca@gmail.com',
            'password' => bcrypt('12345678'),
            'apellidopaterno' => 'Lopez',
            'apellidomaterno' => 'Majo',
            'ci' => '7867856',
            'expedito' => 'LP', // Ejemplo
            'estado' => true,
            'foto' => 'users/lauralaura.jpeg', // Ejemplo
            'genero' => true, // Ejemplo
            'cargo' => 'Sumariante', // Ejemplo
            'unidad' => 'Sumariantes', // Ejemplo
            'fnacimiento' => '1997-05-22',
            'finicio' => '2024-04-30',
            'fsuspension' => null, // Ejemplo
        ])->assignRole('sumariante');
        
        User::create([
            'name' =>'angel',
            'email' =>'angel@gmail.com',
            'password' => bcrypt('2783921'),
            'apellidopaterno' => 'Vargas',
            'apellidomaterno' => 'Mariel',
            'ci' => '2783921',
            'expedito' => 'LP', // Ejemplo
            'estado' => true,
            'foto' => 'users/jalcides.jpg', // Ejemplo
            'genero' => true, // Ejemplo
            'cargo' => 'abogado', // Ejemplo
            'unidad' => 'Sumariante', // Ejemplo
            'fnacimiento' => '1996-07-02',
            'finicio' => '2024-04-30',
            'fsuspension' => null, // Ejemplo
        ])->assignRole('abogado');
     
         User::create([
            'name' =>'abril',
            'email' =>'abril@gmail.com',
            'password' => bcrypt('ab1234562la'),
            'apellidopaterno' => 'laza',
            'apellidomaterno' => 'vela',
            'ci' => '1234562',
            'expedito' => 'LP', // Ejemplo
            'estado' => true,
            'foto' => 'users/lauralaura.jpeg', // Ejemplo
            'genero' => true, // Ejemplo
            'cargo' => 'local', // Ejemplo
            'unidad' => 'sistemas', // Ejemplo
            'fnacimiento' => '1999-12-21',
            'finicio' => '2024-04-30',
            'fsuspension' => null, // Ejemplo
        ])->assignRole('secretaria');

         User::create([
            'name' =>'laura',
            'email' =>'laura@gmail.com',
            'password' => bcrypt('la6921903la'),
            'apellidopaterno' => 'laura',
            'apellidomaterno' => 'vela',
            'ci' => '6921903',
            'expedito' => 'LP', // Ejemplo
            'estado' => true,
            'foto' => 'users/lauralaura.jpeg', // Ejemplo
            'genero' => true, // Ejemplo
            'cargo' => 'local', // Ejemplo
            'unidad' => 'sistemas', // Ejemplo
            'fnacimiento' => '1999-09-29',
            'finicio' => '2024-04-30',
            'fsuspension' => null, // Ejemplo
        ])->assignRole('pasante');
            
        User::create([
            'name' =>'juan',
            'email' =>'juan@gmail.com',
            'password' => bcrypt('12345678'),
            'apellidopaterno' => 'perez',
            'apellidomaterno' => 'perez',
            'ci' => '12345678',
            'expedito' => 'LP', // Ejemplo
            'estado' => true,
            'foto' => 'users/jalcides.jpg', // Ejemplo
            'genero' => true, // Ejemplo
            'cargo' => 'Administrador', // Ejemplo
            'unidad' => 'Administración', // Ejemplo
            'fnacimiento' => '1999-11-22',
            'finicio' => '2024-04-30',
            'fsuspension' => null, // Ejemplo
        ])->assignRole('sumariado');

       //user::factory(9)->create();
    }

}
