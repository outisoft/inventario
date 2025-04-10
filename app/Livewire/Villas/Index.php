<?php

namespace App\Livewire\Villas;

use App\Models\Villa;
use Livewire\Component;

class Index extends Component
{
    public $villas;
    public $villaIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->villas = Villa::orderBy('name', 'asc')->get();
    }

    public function confirmDelete($id)
    {
        $this->villaIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Villa::findOrFail($this->villaIdToDelete)->delete();
        $this->villas = Villa::orderBy('name', 'asc')->get();
        $this->showDeleteModal = false;

        toastr()->success('Villa deleted successfully!');

        return redirect()->route('villas');
    }

    public function render()
    {
        return view('livewire.villas.index');
    }
}
