<?php

namespace App\Livewire\Departments;

use Livewire\Component;
use App\Models\Department;
use App\Models\Hotel;

class CreateDepartment extends Component
{
    public $name;
    public $hotel_id;
    public $hotels;

    public function mount()
    {
        $this->hotels = Hotel::orderBy('name', 'asc')->get();
    }

    public function createDepartment()
    {
        $this->validate([
            'name' => 'required|min:2',
            'hotel_id' => 'required|min:3',
        ],[
            'name.required' => 'El nombre del departamento es obligatorio.',
            'hotel_id.required' => 'El hotel del departamento es obligatorio.',
        ]);

        $department = Department::create([
            'name' => $this->name,
            'hotel_id' => $this->hotel_id,
        ]);

        toastr()->success('Departamento saved successfully!');

        return redirect()->route('departments');
    }

    public function render()
    {
        return view('livewire.departments.create', [
            'hotels' => $this->hotels,
        ]);
    }
}