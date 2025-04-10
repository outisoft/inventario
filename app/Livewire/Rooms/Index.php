<?php

namespace App\Livewire\Rooms;

use App\Models\Room;
use Livewire\Component;

class Index extends Component
{
    public $rooms;
    public $roomIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->rooms = Room::orderBy('number', 'asc')->get();
    }

    public function confirmDelete($id)
    {
        $this->roomIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Room::findOrFail($this->roomIdToDelete)->delete();
        $this->rooms = Room::orderBy('number', 'asc')->get();
        $this->showDeleteModal = false;

        toastr()->success('Villa deleted successfully!');

        return redirect()->route('rooms');
    }

    public function render()
    {
        return view('livewire.rooms.index');
    }
}
