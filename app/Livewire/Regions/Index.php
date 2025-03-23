<?php

namespace App\Livewire\Regions;

use Livewire\Component;
use App\Models\Region;

class Index extends Component
{
    public $regions;
    public $regionIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->regions = Region::all();
    }

    public function confirmDelete($id)
    {
        $this->regionIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Region::findOrFail($this->regionIdToDelete)->delete();
        $this->regions = Region::all();
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.regions.index', ['regions' => $this->regions]);
    }
}