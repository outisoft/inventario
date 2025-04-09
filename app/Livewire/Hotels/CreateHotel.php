<?php

namespace App\Livewire\Hotels;

use Livewire\Component;
use App\Models\Hotel;
use App\Models\Region;

class CreateHotel extends Component
{
    public $name;
    public $type;
    public $region_id;
    public $regions;

    public function mount()
    {
        $this->regions = Region::orderBy('name', 'asc')->get();
    }

    public function createHotel()
    {
        $this->validate([
            'name' => 'required|min:3',
            'type' => 'required|min:3',
            'region_id' => 'required|min:3',
        ],[
            'name.required' => 'El nombre del hotel es obligatorio.',
            'region_id.required' => 'La region del hotel es obligatorio.',
        ]);

        $hotel = Hotel::create([
            'name' => $this->name,
            'type' => $this->type,
            'region_id' => $this->region_id,
        ]);

        toastr()->success('Hotel saved successfully!');

        return redirect()->route('hotels');
    }

    public function render()
    {
        return view('livewire.hotels.create', [
            'regions' => $this->regions,
        ]);
    }
}
