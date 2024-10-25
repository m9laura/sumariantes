<?php

namespace App\Policies;

use App\Models\User;
use App\Models\persona_tipo_persona;
use Illuminate\Auth\Access\Response;

class PersonaTipoPersonaPolicy
{
   
    public function view(User $user, persona_tipo_persona $personaTipoPersona)
    {
        // Lógica para determinar si el usuario puede ver el recurso
        return $user->hasPermissionTo('persona_tipo_personas.show');
    }

    public function edit(User $user, persona_tipo_persona $personaTipoPersona)
    {
        return $user->hasPermissionTo('persona_tipo_personas.edit');
    }

    public function delete(User $user, persona_tipo_persona $personaTipoPersona)
    {
        return $user->hasPermissionTo('persona_tipo_personas.destroy');
    }

    public function generatePdf(User $user, persona_tipo_persona $personaTipoPersona)
    {
        return $user->hasPermissionTo('persona_tipo_personas.pdf');
    }
}