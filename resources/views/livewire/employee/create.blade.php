<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    @include('partials.employee-create-heading')
    <!-- Formulario para agregar un nuevo usuario -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="createEmployee">

            <div class="mb-4">            
                <flux:input type="text" id="name" wire:model="name" label="Name" :placeholder="__('NAME')" required/>
            </div>

            <div class="mb-4">            
                <flux:input type="text" id="no_employee" wire:model="no_employee" label="NO EMPLOYEE" :placeholder="__('NO EMPLOYEE')" required/>
            </div>
            
            <div class="mb-4">
                <label class="block mb-2 font-semibold">¿El puesto ya existe?</label>
                <div class="flex gap-4">
                    <label>
                        <input type="radio" wire:model="position_exists" value="1" /> Sí
                    </label>
                    <label>
                        <input type="radio" wire:model="position_exists" value="0" /> No
                    </label>
                </div>
            </div>

            @if($position_exists == '1')
                <!-- Select de puestos existentes -->
                <div class="mb-4">
                    <flux:select size="sm" placeholder="Choose position..." name="position_id" id="position_id" wire:model="position_id" label="Positions" required>
                        @foreach($positions as $position)
                            <flux:select.option value="{{ $position->id }}">{{ $position->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
            @else
                <!-- Campos para crear nuevo puesto -->
                <div class="mb-4">
                    <flux:input type="text" id="position_name" wire:model="position_name" label="Nombre del nuevo puesto" placeholder="Nombre del puesto" required/>
                    <flux:input type="email" id="position_email" wire:model="position_email" label="Correo del puesto" placeholder="Correo" required/>
                    <flux:input type="text" id="position_ad" wire:model="position_ad" label="AD del puesto" placeholder="AD" required/>
                    <flux:select size="sm" placeholder="Selecciona hotel..." name="hotel_id" id="hotel_id" wire:model="hotel_id" label="Hotel" required>
                        @foreach($hotels as $hotel)
                            <flux:select.option value="{{ $hotel->id }}">{{ $hotel->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:select size="sm" placeholder="Selecciona departamento..." name="department_id" id="department_id" wire:model="department_id" label="Departamento" required>
                        @foreach($departments as $department)
                            <flux:select.option value="{{ $department->id }}">{{ $department->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
            @endif

            <div class="mb-4">   
                <flux:select size="sm" placeholder="Choose industry..." name="regions[]" id="region_id" wire:model="region_id" label="Region" required>
                    @foreach($regions as $region)
                        <flux:select.option value="{{ $region->id }}">{{ $region->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <br>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
            <button type="button" onclick="history.back()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">Cancel</button>
        </form>
    </div>
</div>