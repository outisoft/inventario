<?php
namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EditRole extends Component
{
    public $roleId;
    public $name;
    public $permissions = [];
    public $selectedPermissions = [];

    public function mount($roleId)
    {
        $this->roleId = $roleId;
        $role = Role::findOrFail($this->roleId);

        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray(); // IDs de permisos seleccionados
        $this->permissions = Permission::all(); // Todos los permisos disponibles
    }

    public function updateRole()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'selectedPermissions' => 'array|exists:permissions,id', // Validar que los IDs existan en la tabla de permisos
        ]);
    
        $role = Role::findOrFail($this->roleId);
    
        // Actualizar el nombre del rol y sincronizar permisos
        $role->update(['name' => $this->name]);
        $role->permissions()->sync($this->selectedPermissions);

        session()->flash('message', 'El rol ha sido actualizado exitosamente.');
        return redirect()->route('roles');
    }

    public function render()
    {
        return view('livewire.roles.edit', [
            'permissions' => $this->permissions,
        ]);
    }
}