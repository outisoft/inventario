<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Region;
use App\Models\Hotel;
use App\Models\Department;

class Create extends Component
{
    public $name;
    public $no_employee;
    public $position_id;
    public $positions;
    public $region_id;
    public $regions;
    public $position_exists = '1'; // Por defecto, sí existe
    public $position_name;
    public $position_email;
    public $position_ad;
    public $hotels;
    public $hotel_id;
    public $departments;
    public $department_id;

    public function mount()
    {
        $this->positions = Position::orderBy('name', 'asc')->get();
        $this->regions = Region::orderBy('name', 'asc')->get();
        $this->hotels = Hotel::orderBy('name', 'asc')->get();
        $this->departments = Department::orderBy('name', 'asc')->get();
    }

    public function updatedPositionExists($value)
    {
        if ($value === '1') {
            $this->position_name = null;
            $this->position_email = null;
            $this->position_ad = null;
            $this->hotel_id = null;
            $this->department_id = null;
        } else {
            $this->position_id = null;
        }
    }

    public function createEmployee()
    {
        if ($this->position_exists === '1') {
            $this->validate([
                'name' => 'required|string|max:255',
                'no_employee' => 'required|string|max:255|unique:employees',
                'position_id' => 'nullable|exists:positions,id',
                'region_id' => 'nullable|exists:regions,id',
            ]);

            $positionId = $this->position_id;
        } else {

            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:positions',
                'ad' => 'required|string|max:255',
                'hotel_id' => 'required|exists:hotels,id',
                'department_id' => 'required|exists:departments,id',
                'region_id' => 'required|exists:regions,id',
            ]);

            $position = Position::create([
                'name' => $this->position_name,
                'email' => $this->position_email,
                'ad' => $this->position_ad,
                'hotel_id' => $this->hotel_id,
                'department_id' => $this->department_id,
                'region_id' => $this->region_id,
            ]);

            $positionId = $position->id;
        }

        Employee::create([
            'name' => $this->name,
            'no_employee' => $this->no_employee,
            'position_id' => $this->positionId,
            'region_id' => $this->region_id,
        ]);

        toastr()->success('Employee saved successfully!');

        return redirect()->route('employees');
    }
    public function render()
    {
        return view('livewire.employee.create');
    }
}
