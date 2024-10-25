<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'administrador']);
        $role2 = Role::create(['name'=>'sumariante']);
        $role3 = Role::create(['name'=>'abogado']);
        $role4 = Role::create(['name'=>'secretaria']);
        $role5 = Role::create(['name'=>'pasante']);
        $role6 = Role::create(['name'=>'sumariado']);
        
    
        Permission::create(['name'=>'home'])->assignRole([$role1, $role2, $role3, $role4, $role5]);

        Permission::create(['name'=>'users.create','description'=>'Crear usuarios'])->assignRole($role1, $role2);
        Permission::create(['name'=>'users.index','description'=>'Mostrar usuarios'])->assignRole([$role1, $role2]);
        Permission::create(['name'=>'users.edit','description'=>'Editar usuarios'])->assignRole([$role1, $role2]);
        Permission::create(['name'=>'users.show','description'=>'Ver usuarios'])->assignRole([$role1, $role2]);
        Permission::create(['name'=>'users.destroy','description'=>'Eliminar usuarios'])->assignRole([$role1]);

        Permission::create(['name'=>'personas.create','description'=>'Crear sumarios'])->assignRole([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name'=>'personas.index','description'=>'Listar sumarios'])->assignRole([$role1,$role2, $role3, $role4, $role5]);
        Permission::create(['name'=>'personas.edit','description'=>'Editar sumarios'])->assignRole([$role1, $role2,$role3,$role4, $role5]);
        Permission::create(['name'=>'personas.show','description'=>'Ver sumarios'])->assignRole([$role1,$role2,$role3, $role4,$role5]);
        Permission::create(['name'=>'personas.destroy','description'=>'Eliminar sumarios'])->assignRole([$role1]);

        Permission::create(['name'=>'roles.create','description'=>'Crear roles'])->assignRole([$role1, $role2 ]);
        Permission::create(['name'=>'roles.index','description'=>'Mostar roles'])->assignRole([$role1, $role2 ]);
        Permission::create(['name'=>'roles.edit','description'=>'Editar roles'])->assignRole([$role1, $role2 ]);
        Permission::create(['name'=>'roles.show','description'=>'Ver perfil'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'roles.destroy','description'=>'Eliminar roles'])->assignRole([$role1, $role2]);

        Permission::create(['name'=>'casos.create','description'=>'Crear casos'])->assignRole([$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name'=>'casos.index','description'=>'Listar casos'])->assignRole([$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name'=>'casos.edit','description'=>'Editar casos'])->assignRole([$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name'=>'casos.show','description'=>'Ver casos'])->assignRole([$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name'=>'casos.destroy','description'=>'Eliminar casos'])->assignRole([$role1,$role2]);

        Permission::create(['name'=>'actuas.create','description'=>'Crear actuados'])->assignRole([$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name'=>'actuas.index','description'=>'Mostar actuados'])->assignRole([$role1,$role2,$role3,$role4,$role5 ]);
        Permission::create(['name'=>'actuas.edit','description'=>'Editar actuados'])->assignRole([$role1,$role2,$role3,$role4,$role5 ]);
        Permission::create(['name'=>'actuas.show','description'=>'Ver peactuado'])->assignRole([$role1,$role2,$role3,$role4,$role5 ]);
        Permission::create(['name'=>'actuas.destroy','description'=>'Eliminar actuados'])->assignRole([$role1,$role2]);

        // cambio
        // Permission::create(['name'=>'tipo_mensajes.create','description'=>'Crear tipo de mensaje'])->assignRole([$role1]);
        // Permission::create(['name'=>'tipo_mensajes.index','description'=>'Mostrar tipo de mensaje'])->assignRole([$role1]);
        // Permission::create(['name'=>'tipo_mensajes.edit','description'=>'Editar tipo de mensaje'])->assignRole([$role1]);
        // Permission::create(['name'=>'tipo_mensajes.destroy','description'=>'Eliminar tipo de mensaje'])->assignRole([$role1]);

        Permission::create(['name'=>'tipo_personas.create','description'=>'Crear tipo de persona'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_personas.index','description'=>'Mostrar tipo de persona'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_personas.edit','description'=>'Editar tipo de persona'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_personas.destroy','description'=>'Eliminar tipo de persona'])->assignRole([$role1,$role2]);

        Permission::create(['name'=>'tipo_casos.create','description'=>'Crear tipo de caso'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_casos.index','description'=>'Listor tipo de caso'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_casos.edit','description'=>'Editar tipo de caso'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_casos.show','description'=>'Mostrar tipo de caso'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'tipo_casos.destroy','description'=>'Eliminar tipo de caso'])->assignRole([$role1,$role2]);

        // Permission::create(['name'=>'casos.create','description'=>'Crear casos'])->assignRole([$role1,$role2]);
        // Permission::create(['name'=>'casos.index','description'=>'Listar casos'])->assignRole([$role1,$role2]);
        // Permission::create(['name'=>'casos.edit','description'=>'Editar casos'])->assignRole([$role1,$role2]);
        // Permission::create(['name'=>'casos.show','description'=>'Ver casos'])->assignRole([$role1,$role2]);
        // Permission::create(['name'=>'casos.destroy','description'=>'Eliminar casos'])->assignRole([$role1,$role2]);

        Permission::create(['name'=>'busquedas.pdf','description'=>'Descargar pdf de busquedas'])->assignRole([$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name'=>'busquedas.index','description'=>'Acceser al filtro de busquedas'])->assignRole([$role1,$role2,$role3,$role4,$role5]);
        // Permission::create(['name'=>'busquedas.edit','description'=>'Editar busquedas'])->assignRole([$role1,$role2]);
        Permission::create(['name'=>'busquedas.show','description'=>'Ver busquedas'])->assignRole([$role1,$role2,$role3,$role4,$role5]);
        
        // Permission::create(['name'=>'busquedas.destroy','description'=>'Eliminar busquedas'])->assignRole([$role1,$role2]);

        // Permission::create(['name'=>'mensajes.create','description'=>'Enviar mensajes'])->assignRole([$role1 ]);
        // Permission::create(['name'=>'mensajes.index','description'=>'Mostrar estadisticas'])->assignRole([$role1 ]);

        Permission::create(['name'=>'reportes.show','description'=>'Ver busquedas'])->assignRole([$role1,$role2,$role3,$role4,$role5]);

        Permission::create(['name'=>'sancions.create','description'=>'Crear actuados'])->assignRole([$role1,$role2,$role3]);
        Permission::create(['name'=>'sancions.index','description'=>'Mostar actuados'])->assignRole([$role1,$role2,$role3]);
        Permission::create(['name'=>'sancions.edit','description'=>'Editar actuados'])->assignRole([$role1,$role2,$role3]);
        Permission::create(['name'=>'sancions.show','description'=>'Ver peactuado'])->assignRole([$role1,$role2,$role3]);
        Permission::create(['name'=>'sancions.destroy','description'=>'Eliminar actuados'])->assignRole([$role1,$role2]);

        Permission::create(['name'=>'sancion_personas.create','description'=>'Crear actuados'])->assignRole([$role1]);
        Permission::create(['name'=>'sancion_personas.index','description'=>'Mostar actuados'])->assignRole([$role1]);
        Permission::create(['name'=>'sancion_personas.edit','description'=>'Editar actuados'])->assignRole([$role1]);
        Permission::create(['name'=>'sancion_personas.show','description'=>'Ver peactuado'])->assignRole([$role1]);
        Permission::create(['name'=>'sancion_personas.sancionartodos','description'=>'Eliminar actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'sancion_personas.destroy','description'=>'Eliminar actuados'])->assignRole([$role1 ]);


        Permission::create(['name'=>'personas_tipo_personas.create','description'=>'Crear actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'personas_tipo_personas.index','description'=>'Mostar actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'personas_tipo_personas.edit','description'=>'Editar actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'personas_tipo_personas.show','description'=>'Ver peactuado'])->assignRole([$role1]);
        Permission::create(['name'=>'personas_tipo_personas.destroy','description'=>'Eliminar actuados'])->assignRole([$role1 ]);
        
        Permission::create(['name'=>'caso_actuados.create','description'=>'Crear actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'caso_actuados.index','description'=>'Mostar actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'caso_actuados.edit','description'=>'Editar actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'caso_actuados.show','description'=>'Ver peactuado'])->assignRole([$role1]);
        Permission::create(['name'=>'caso_actuados.destroy','description'=>'Eliminar actuados'])->assignRole([$role1 ]);
    
        Permission::create(['name'=>'caso_personas.create','description'=>'Crear actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'caso_personas.index','description'=>'Mostar actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'caso_personas.edit','description'=>'Editar actuados'])->assignRole([$role1 ]);
        Permission::create(['name'=>'caso_personas.show','description'=>'Ver peactuado'])->assignRole([$role1]);
        Permission::create(['name'=>'caso_personas.destroy','description'=>'Eliminar actuados'])->assignRole([$role1]);

    }
}
