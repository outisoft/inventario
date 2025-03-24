<?php

namespace App\Livewire\Policies;

use Livewire\Component;
use App\Models\Policy;

class Index extends Component
{
    public $policies;
    public $policyIdToDelete;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->policies = Policy::orderBy('name', 'asc')->get();
    }

    public function confirmDelete($id)
    {
        $this->policyIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Policy::findOrFail($this->policyIdToDelete)->delete();
        $this->policies = Policy::orderBy('name', 'asc')->get();
        $this->showDeleteModal = false;

        toastr()->success('Policy deleted successfully!');

    }

    public function render()
    {
        return view('livewire.policies.index', ['policies' => $this->policies]);
    }
}
