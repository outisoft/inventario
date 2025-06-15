<?php

namespace App\Livewire\Position;

use Livewire\Component;
use App\Models\Position;
use App\Models\Region;
use App\Models\Hotel;
use App\Models\Department;

class Create extends Component
{
    public $name;
    public $email;
    public $ad;
    public $hotel_id;
    public $department_id;
    public $region_id;
    public $hotels;
    public $departments;
    public $regions;

    public function mount()
    {
        $this->regions = Region::orderBy('name', 'asc')->get();
        $this->hotels = Hotel::orderBy('name', 'asc')->get();
        $this->departments = Department::orderBy('name', 'asc')->get();
    }

    public function createPosition()
    {        
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:positions',
            'ad' => 'required|string|max:255',
            'hotel_id' => 'required|exists:hotels,id',
            'department_id' => 'required|exists:departments,id',
            'region_id' => 'required|exists:regions,id',
        ]);

        Position::create([
            'name' => $this->name,
            'email' => $this->email,
            'ad' => $this->ad,
            'hotel_id' => $this->hotel_id,
            'department_id' => $this->department_id,
            'region_id' => $this->region_id,
        ]);

        toastr()->success('Position saved successfully!');

        return redirect()->route('positions');
    }

    public function render()
    {
        return view('livewire.position.create');
    }
}
