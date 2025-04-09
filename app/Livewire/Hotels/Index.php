<?php

namespace App\Livewire\Hotels;

use App\Models\Hotel;
use Livewire\Component;

class Index extends Component
{
    public $hotels;
    public $hotelsIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->hotels = Hotel::orderBy('name', 'asc')->get();
    }

    public function confirmDelete($id)
    {
        $this->hotelsIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Hotel::findOrFail($this->hotelsIdToDelete)->delete();
        $this->hotels = Hotel::orderBy('name', 'asc')->get();
        $this->showDeleteModal = false;

        toastr()->success('Hotel deleted successfully!');

    }

    public function render()
    {
        return view('livewire.hotels.index', ['hotels' => $this->hotels]);
    }
}
