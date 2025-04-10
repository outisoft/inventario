<?php

namespace App\Livewire\Rooms;

use Livewire\Component;
use App\Models\Villa;
use App\Models\Room;

class CreateRoom extends Component
{
    public $number;
    public $villa_id;
    public $villas;

    public function mount()
    {
        $this->villas = Villa::orderBy('name', 'asc')->get();
    }

    public function createRoom()
    {
        $this->validate([
            'number' => 'required|min:1',
            'villa_id' => 'required|min:2',
        ],[
            'number.required' => 'El numero de habitacion es obligatorio.',
            'villa_id.required' => 'La villa de habitacion es obligatorio.',
        ]);

        $room = Room::create([
            'number' => $this->number,
            'villa_id' => $this->villa_id,
        ]);

        toastr()->success('Villa saved successfully!');

        return redirect()->route('rooms');
    }

    public function render()
    {
        return view('livewire.rooms.create', [
            'villas' => $this->villas,
        ]);
    }
}