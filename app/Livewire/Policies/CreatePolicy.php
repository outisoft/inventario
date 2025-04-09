<?php

namespace App\Livewire\Policies;

use Livewire\Component;
use App\Models\Policy;
use App\Models\Region;

class CreatePolicy extends Component
{
    public $name;
    public $region_id;

    public function mount()
    {
        $this->regions = Region::orderBy('name', 'asc')->get();
    }

    public function createPolicy()
    {
        $this->validate([
            'name' => 'required|min:3',
            'region_id' => 'required|min:3',
        ],[
            'name.required' => 'El nombre de la politica es obligatorio.',
            'region_id.required' => 'La region de la politica es obligatorio.',
        ]);

        $policy = Policy::create([
            'name' => $this->name,
            'region_id' => $this->region_id,
        ]);

        toastr()->success('Policy saved successfully!');

        return redirect()->route('policies');
    }

    public function render()
    {
        return view('livewire.policies.create', [
            'regions' => $this->regions,
        ]);
    }
}