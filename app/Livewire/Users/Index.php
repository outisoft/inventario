<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users;
    public $userIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->users = User::orderBy('name', 'asc')->get();
    }

    public function confirmDelete($id)
    {
        $this->userIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        User::findOrFail($this->userIdToDelete)->delete();
        $this->users = User::orderBy('name', 'asc')->get();
        $this->showDeleteModal = false;

        toastr()->success('User deleted successfully!');

    }

    public function render()
    {
        return view('livewire.users.index', ['users' => $this->users]);
    }
}