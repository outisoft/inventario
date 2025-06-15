<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    @include('partials.position-heading')
    <!-- Formulario para agregar un nuevo usuario -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="createPosition">

            <div class="mb-4">            
                <flux:input type="text" id="name" wire:model="name" label="Name" :placeholder="__('Name')" required/>
            </div>

            <div class="mb-4">            
                <flux:input type="email" id="email" wire:model="email" label="Email" :placeholder="__('example@email.com')" required/>
            </div>

            <div class="mb-4">            
                <flux:input type="text" id="naadme" wire:model="ad" label="AD" :placeholder="__('AD')" required/>
            </div>

            <div class="mb-4">   
                <flux:select size="sm" placeholder="Choose industry..." name="hotels[]" id="hotel_id" wire:model="hotel_id" label="Hotel" required>
                    @foreach($hotels as $hotel)
                        <flux:select.option value="{{ $hotel->id }}">{{ $hotel->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <div class="mb-4">   
                <flux:select size="sm" placeholder="Choose department..." name="departments[]" id="department_id" wire:model="department_id" label="Department" required>
                    @foreach($departments as $department)
                        <flux:select.option value="{{ $department->id }}">{{ $department->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

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