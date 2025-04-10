<?php

namespace App\Livewire\Departments;

use Livewire\Component;
use App\Models\Department;
use App\Models\Hotel;

class EditDepartment extends Component
{
    public $departmentId;
    public $name;
    public $hotel_id;
    public $hotels; 

    public function mount($id)
    {
        $department = Department::findOrFail($id);
        $this->departmentId = $department->id;
        $this->name = $department->name;
        $this->hotel_id = strtolower($department->hotel_id); 
        $this->hotels = Hotel::orderBy('name', 'asc')->get();
    }

    public function updateDepartment()
    {
        $this->validate([
            'name' => 'required|min:2',
            'hotel_id' => 'required|min:3',
        ],[
            'name.required' => 'El nombre del departamento es obligatorio.',
            'hotel_id.required' => 'El hotel del departamento es obligatorio.',
        ]);

        $department = Hotel::findOrFail($this->departmentId);
        $department->update([
            'name' => $this->name,
            'hotel_id' => $this->hotel_id,
        ]);

        toastr()->success('Department updated successfully!');

        return redirect()->route('departments');
    }

    public function render()
    {
        return view('livewire.departments.edit', [
            'hotels' => $this->hotels,
        ]);
    }
}