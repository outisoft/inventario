<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRole extends Component
{
    public $name;
    public $permissions = [];
    public $selectedPermissions = [];

    public function mount()
    {
        // Cargar todos los permisos disponibles
        $this->permissions = Permission::all();
    }

    public function createRole()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'selectedPermissions' => 'array|exists:permissions,id', // Validar que los IDs existan en la tabla de permisos
        ]);
    
        // Crear el rol
        $role = Role::create([
            'name' => $this->name,
        ]);
    
        // Asignar permisos al nuevo rol
        $role->givePermissionTo(Permission::whereIn('id', $this->selectedPermissions)->pluck('name')->toArray());    

        // Mensaje de éxito
        session()->flash('message', 'Rol creado exitosamente.');

        // Redirigir a la lista de roles
        return redirect()->route('roles');
    }

    public function render()
    {
        return view('livewire.roles.create', [
            'permissions' => $this->permissions,
        ]);
    }
}