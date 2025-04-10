<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use Livewire\Component;

class Index extends Component
{
    public $departments;
    public $departmentIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->departments = Department::orderBy('name', 'asc')->get();
    }

    public function confirmDelete($id)
    {
        $this->departmentIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Department::findOrFail($this->departmentIdToDelete)->delete();
        $this->departments = Department::orderBy('name', 'asc')->get();
        $this->showDeleteModal = false;

        toastr()->success('Department deleted successfully!');

        return redirect()->route('departments');
    }


    public function render()
    {
        return view('livewire.departments.index', ['departments' => $this->departments]);
    }
}
