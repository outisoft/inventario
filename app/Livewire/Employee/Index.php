<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;

class Index extends Component
{
    public $employees;
    public $employeeIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->employees = Employee::orderBy('name', 'asc')->get();
    }

    public function confirmDelete($id)
    {
        $this->employeeIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Employee::findOrFail($this->employeeIdToDelete)->delete();
        $this->employees = Employee::orderBy('name', 'asc')->get();
        $this->showDeleteModal = false;

        toastr()->success('Employee deleted successfully!');
    }

    public function render()
    {
        return view('livewire.employee.index');
    }
}
