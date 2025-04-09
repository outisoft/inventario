<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Formulario para agregar un nuevo usuario -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="createUser">

            <div class="mb-4">            
                <flux:input type="text" id="name" wire:model="name" label="Name" :placeholder="__('Name')" required/>
            </div>

            <div class="mb-4">            
                <flux:input type="email" id="email" wire:model="email" label="Email" :placeholder="__('example@email.com')" required/>
            </div>

            <div class="mb-4">   
                <flux:select size="sm" placeholder="Choose rol..." name="rol" id="rol" wire:model="rol" label="Rol" required>
                    <flux:select.option value="" disabled selected>Seleccione un rol</flux:select.option>
                    @foreach($roles as $role)
                        <flux:select.option value="{{ $role->id }}">{{ $role->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <div class="mb-4">   
                <flux:select size="sm" placeholder="Choose industry..." name="regions[]" id="regions" wire:model="region_ids" multiple label="Region" required>
                    @foreach($regions as $region)
                        <flux:select.option value="{{ $region->id }}">{{ $region->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <!-- Password -->
            <div class="mb-4">  
                <flux:input
                    wire:model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                />
            </div>


            <!-- Confirm Password -->
            <div class="mb-4">  
                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Confirm password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Confirm password')"
                />
            </div>

            <br>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
        </form>
    </div>
</div>