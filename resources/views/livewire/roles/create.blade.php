<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Formulario para agregar una nueva región -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="createRole">
            <div class="mb-4">            
                <flux:input type="text" id="name" wire:model="name" label="Name" :placeholder="__('Name')" required/>
            </div>

            <flux:checkbox.group wire:model="permissions" label="Permissions">
                <flux:checkbox.all label="Select All" />

                @foreach($permissions as $permission)
                    <flux:checkbox label="{{ $permission->description }}" value="{{ $permission->id }}" />
                @endforeach
            </flux:checkbox.group>
            <br>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
        </form>
    </div>
</div>