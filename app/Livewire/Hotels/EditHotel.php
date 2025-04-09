<?php

namespace App\Livewire\Hotels;

use Livewire\Component;
use App\Models\Hotel;
use App\Models\Region;

class EditHotel extends Component
{
    public $hotelId;
    public $name;
    public $type;
    public $region_id;
    public $regions; 

    public function mount($id)
    {
        $hotel = Hotel::findOrFail($id);
        $this->hotelId = $hotel->id;
        $this->name = $hotel->name;
        $this->type = $hotel->type;
        $this->region_id = strtolower($hotel->region_id); 
        $this->regions = Region::orderBy('name', 'asc')->get();
    }

    public function updateHotel()
    {
        $this->validate([
            'name' => 'required|min:3',
            'type' => 'required|min:3',
            'region_id' => 'required|min:3',
        ],[
            'name.required' => 'El nombre del hotel es obligatorio.',
            'type.required' => 'El tipo del hotel es obligatorio.',
            'region_id.required' => 'La region del hotel es obligatorio.',
        ]);

        $hotel = Hotel::findOrFail($this->hotelId);
        $hotel->update([
            'name' => $this->name,
            'type' => $this->type,
            'region_id' => $this->region_id,
        ]);

        toastr()->success('Hotel updated successfully!');

        return redirect()->route('hotels');
    }

    public function render()
    {
        return view('livewire.hotels.edit', [
            'regions' => $this->regions,
        ]);
    }
}