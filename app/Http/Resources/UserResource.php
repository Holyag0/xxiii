<?php

namespace App\Http\Resources;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $roles = ListRoles($this->roles);
        $cfcs = ListCfcs($this->cfcs);
       
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'cfc_id' => $this->cfc_id,
            'cfc_selecionado' => $this->cfc_selecionado,
            'aluno_id' => $this->aluno_id,
            'cfcs' => $cfcs,
            'roles' => $roles
        ];
    }
}
