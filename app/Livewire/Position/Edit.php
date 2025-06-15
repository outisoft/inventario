<?php

namespace App\Livewire\Position;

use Livewire\Component;

class Edit extends Component
{
    public $positionId;
    public $name;
    public $email;
    public $ad;
    public $hotel_id;
    public $department_id;
    public $region_id;
    public $hotels;
    public $departments;
    public $regions;
    public $position;

    public function mount($id)
    {
        $this->positionId = $id;
        $this->position = \App\Models\Position::findOrFail($this->positionId);
        $this->name = $this->position->name;
        $this->email = $this->position->email;
        $this->ad = $this->position->ad;
        $this->hotel_id = $this->position->hotel_id;
        $this->department_id = $this->position->department_id;
        $this->region_id = $this->position->region_id;

        $this->regions = \App\Models\Region::orderBy('name', 'asc')->get();
        $this->hotels = \App\Models\Hotel::orderBy('name', 'asc')->get();
        $this->departments = \App\Models\Department::orderBy('name', 'asc')->get();
    }

    public function updatePosition()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:positions,email,' . $this->positionId,
            'ad' => 'required|string|max:255',
            'hotel_id' => 'required|exists:hotels,id',
            'department_id' => 'required|exists:departments,id',
            'region_id' => 'required|exists:regions,id',
        ]);

        $this->position->update([
            'name' => $this->name,
            'email' => $this->email,
            'ad' => $this->ad,
            'hotel_id' => $this->hotel_id,
            'department_id' => $this->department_id,
            'region_id' => $this->region_id,
        ]);

        toastr()->success('Position updated successfully!');

        return redirect()->route('positions');
    }
    
    public function render()
    {
        return view('livewire.position.edit');
    }
}
