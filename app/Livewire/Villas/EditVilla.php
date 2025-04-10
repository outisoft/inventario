<?php

namespace App\Livewire\Villas;

use Livewire\Component;
use App\Models\Villa;
use App\Models\Hotel;

class EditVilla extends Component
{
    public $villaId;
    public $name;
    public $hotel_id;
    public $hotels; 

    public function mount($id)
    {
        $villa = Villa::findOrFail($id);
        $this->villaId = $villa->id;
        $this->name = $villa->name;
        $this->hotel_id = strtolower($villa->hotel_id); 
        $this->hotels = Hotel::orderBy('name', 'asc')->get();
    }

    public function updateVilla()
    {
        $this->validate([
            'name' => 'required|min:2',
            'hotel_id' => 'required|min:3',
        ],[
            'name.required' => 'El nombre de la villa es obligatorio.',
            'hotel_id.required' => 'El hotel de la villa es obligatorio.',
        ]);

        $villa = Villa::findOrFail($this->villaId);
        $villa->update([
            'name' => $this->name,
            'hotel_id' => $this->hotel_id,
        ]);

        toastr()->success('Villa updated successfully!');

        return redirect()->route('villas');
    }

    public function render()
    {
        return view('livewire.villas.edit', [
            'hotels' => $this->hotels,
        ]);
    }
}