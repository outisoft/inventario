<?php

namespace App\Livewire\Villas;

use Livewire\Component;
use App\Models\Villa;
use App\Models\Hotel;

class CreateVilla extends Component
{
    public $name;
    public $hotel_id;
    public $hotels;

    public function mount()
    {
        $this->hotels = Hotel::orderBy('name', 'asc')->get();
    }

    public function createVilla()
    {
        $this->validate([
            'name' => 'required|min:2',
            'hotel_id' => 'required|min:3',
        ],[
            'name.required' => 'El nombre de la villa es obligatorio.',
            'hotel_id.required' => 'El hotel de la villa es obligatorio.',
        ]);

        $villa = Villa::create([
            'name' => $this->name,
            'hotel_id' => $this->hotel_id,
        ]);

        toastr()->success('Villa saved successfully!');

        return redirect()->route('villas');
    }

    public function render()
    {
        return view('livewire.villas.create', [
            'hotels' => $this->hotels,
        ]);
    }
}