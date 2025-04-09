<?php

namespace App\Livewire\Roles;

use Spatie\Permission\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public $roles;
    public $roleIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->roles = Role::orderBy('name', 'asc')->get();
    }

    public function confirmDelete($id)
    {
        $this->roleIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Role::findOrFail($this->roleIdToDelete)->delete();
        $this->roles = Role::orderBy('name', 'asc')->get();
        $this->showDeleteModal = false;

        toastr()->success('User deleted successfully!');

    }

    public function render()
    {
        return view('livewire.roles.index', ['roles' => $this->roles]);
    }
}
