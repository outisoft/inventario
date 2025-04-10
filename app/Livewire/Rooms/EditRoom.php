<?php

namespace App\Livewire\Rooms;

use Livewire\Component;
use App\Models\Villa;
use App\Models\Room;

class EditRoom extends Component
{
    public $roomId;
    public $number;
    public $villa_id;
    public $villas; 

    public function mount($id)
    {
        $room = Room::findOrFail($id);
        $this->roomId = $room->id;
        $this->number = $room->number;
        $this->villa_id = strtolower($room->villa_id); 
        $this->villas = Villa::orderBy('name', 'asc')->get();
    }

    public function updateRoom()
    {
        $this->validate([
            'number' => 'required|min:1',
            'villa_id' => 'required|min:3',
        ],[
            'number.required' => 'El numero de habitacion es obligatorio.',
            'villa_id.required' => 'La villa de la habitacion es obligatorio.',
        ]);

        $room = Room::findOrFail($this->roomId);
        $room->update([
            'number' => $this->number,
            'villa_id' => $this->villa_id,
        ]);

        toastr()->success('Room updated successfully!');

        return redirect()->route('rooms');
    }

    public function render()
    {
        return view('livewire.rooms.edit', [
            'villas' => $this->villas,
        ]);
    }
}