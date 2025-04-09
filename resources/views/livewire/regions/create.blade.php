<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Formulario para agregar una nueva región -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="createRegion">
            <div class="mb-4">            
                <flux:input type="text" id="name" wire:model="name" label="Name" description="Enter the name of the region or country" required/>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
        </form>
    </div>
</div>
