<?php

namespace App\Livewire\Policies;

use Livewire\Component;
use App\Models\Policy;
use App\Models\Region;

class EditPolicy extends Component
{
    public $policyId;
    public $name;
    public $region_id;
    public $regions; // Declarar la propiedad para las regiones

    public function mount($id)
    {
        $policy = Policy::findOrFail($id);
        $this->policyId = $policy->id;
        $this->name = $policy->name;
        $this->region_id = strtolower($policy->region_id); // Convertir a minúsculas
        $this->regions = Region::orderBy('name', 'asc')->get(); // Cargar regiones ordenadas
    }

    public function updatePolicy()
    {
        $this->validate([
            'name' => 'required|min:3',
            'region_id' => 'required', // Eliminamos min:3
        ],[
            'name.required' => 'El nombre del hotel es obligatorio.',
            'region_id.required' => 'La región del hotel es obligatoria.',
        ]);

        $policy = Policy::findOrFail($this->policyId);
        $policy->update([
            'name' => $this->name,
            'region_id' => $this->region_id,
        ]);

        toastr()->success('Policy updated successfully!');

        return redirect()->route('policies');
    }

    public function render()
    {
        return view('livewire.policies.edit', [
            'regions' => $this->regions, // Pasar las regiones a la vista
        ]);
    }
}