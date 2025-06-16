<?php

namespace App\Livewire\Employee;

use Livewire\Component;

class Edit extends Component
{
    public $employeeId;
    public $name;
    public $no_employee;
    public $position_id;
    public $positions;
    public $region_id;
    public $regions;
    public $employee;

    public function mount($id)
    {
        $this->employeeId = $id;
        $this->employee = \App\Models\Employee::findOrFail($this->employeeId);
        $this->name = $this->employee->name;
        $this->no_employee = $this->employee->no_employee;
        $this->position_id = $this->employee->position_id;
        $this->region_id = $this->employee->region_id;

        $this->positions = \App\Models\Position::orderBy('name', 'asc')->get();
        $this->regions = \App\Models\Region::orderBy('name', 'asc')->get();
    }
    
    public function updateEmployee()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'no_employee' => 'numeric|required|digits_between:5,8|unique:employees,no_employee,' . $this->employeeId,
            'position_id' => 'nullable|exists:positions,id',
            'region_id' => 'nullable|exists:regions,id',
        ]);

        $this->employee->update([
            'name' => $this->name,
            'no_employee' => $this->no_employee,
            'position_id' => $this->position_id,
            'region_id' => $this->region_id,
        ]);

        toastr()->success('Employee updated successfully!');

        return redirect()->route('employees');
    }

    public function render()
    {
        return view('livewire.employee.edit');
    }
}
