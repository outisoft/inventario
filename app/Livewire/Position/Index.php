<?php

namespace App\Livewire\Position;

Use App\Models\Position;
use Livewire\Component;

class Index extends Component
{
    public $positions;
    public $positionIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->positions = Position::orderBy('name', 'asc')->get();
    }

    public function confirmDelete($id)
    {
        $this->positionIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Position::findOrFail($this->positionIdToDelete)->delete();
        $this->positions = Position::orderBy('name', 'asc')->get();
        $this->showDeleteModal = false;

        toastr()->success('User deleted successfully!');

    }

    public function render()
    {
        return view('livewire.position.index', ['positions' => $this->positions]);
    }
}
