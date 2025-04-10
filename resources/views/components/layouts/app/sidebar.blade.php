<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('home') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group class="grid">
                    <flux:navlist.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>{{ __('Home') }}</flux:navlist.item>
                    <flux:navlist.item icon="users" :href="route('employees')" :current="request()->routeIs('employees')" wire:navigate>{{ __('Employees') }}</flux:navlist.item>
                    <flux:navlist.item icon="briefcase" :href="route('positions')" :current="request()->routeIs('positions')" wire:navigate>{{ __('Positions') }}</flux:navlist.item>
                </flux:navlist.group>

                <flux:navlist.group :heading="__('Equipments')" class="grid" expandable :expanded="false" icon="computer-desktop" icon-trailing="chevron-down">
                    <flux:navlist.item :href="route('equipments.complements')" :current="request()->routeIs('equipments.complements')" wire:navigate>{{ __('Complements') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('equipments.desktops')" :current="request()->routeIs('equipments.desktops')" wire:navigate>{{ __('Desktops') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('equipments.laptops')" :current="request()->routeIs('equipments.laptops')" wire:navigate>{{ __('Laptops') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('equipments.printers')" :current="request()->routeIs('equipments.printers')" wire:navigate>{{ __('Printers') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('equipments.tablets')" :current="request()->routeIs('equipments.tablets')" wire:navigate>{{ __('Tablets') }}</flux:navlist.item>
                </flux:navlist.group>

                <flux:navlist.group :heading="__('Licenses')" class="grid" expandable :expanded="false">
                    <flux:navlist.item :href="route('licenses.autodesk')" :current="request()->routeIs('licenses.autodesk')" wire:navigate>{{ __('Autodesk') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('licenses.adobe')" :current="request()->routeIs('licenses.adobe')" wire:navigate>{{ __('Adobe') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('licenses.office')" :current="request()->routeIs('licenses.office')" wire:navigate>{{ __('Office') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('licenses.sketchup')" :current="request()->routeIs('licenses.sketchup')" wire:navigate>{{ __('Sketchup') }}</flux:navlist.item>
                </flux:navlist.group>

                <flux:navlist.item icon="document-text" :href="route('leases')" :current="request()->routeIs('leases')" wire:navigate>{{ __('Leases') }}</flux:navlist.item>
                <flux:navlist.item icon="arrow-path" :href="route('history')" :current="request()->routeIs('history')" wire:navigate>{{ __('History') }}</flux:navlist.item>
                <flux:navlist.item icon="link" :href="route('assignments')" :current="request()->routeIs('assignments')" wire:navigate>{{ __('Assignments') }}</flux:navlist.item>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Administrator')" class="grid">
                    <flux:navlist.item icon="user-group" :href="route('users')" :current="request()->routeIs('users') || request()->routeIs('users.create') || request()->routeIs('regions.edit') " wire:navigate>{{ __('Users') }}</flux:navlist.item>
                    <flux:navlist.item 
                        icon="building-office-2" 
                        :href="route('hotels')" 
                        :current="request()->routeIs('hotels') || request()->routeIs('hotels.create') || request()->routeIs('hotels.edit') || 
                                request()->routeIs('departments') || request()->routeIs('departments.create') || request()->routeIs('departments.edit') ||
                                request()->routeIs('villas') || request()->routeIs('villas.create') || request()->routeIs('villas.edit')" 
                        wire:navigate>{{ __('Hotels & More') }}</flux:navlist.item>
                    <flux:navlist.item icon="flag" :href="route('regions')" :current="request()->routeIs('regions') || request()->routeIs('regions.create') || request()->routeIs('regions.edit')" wire:navigate>{{ __('Regions') }}</flux:navlist.item>
                    <flux:navlist.item icon="lock-closed" :href="route('roles')" :current="request()->routeIs('roles') || request()->routeIs('roles.create') || request()->routeIs('roles.edit')" wire:navigate>{{ __('Roles & Permissions') }}</flux:navlist.item>
                    <flux:navlist.item icon="clipboard-document-list" :href="route('policies')" :current="request()->routeIs('policies') || request()->routeIs('policies.create') || request()->routeIs('policies.edit')" wire:navigate>{{ __('Policies') }}</flux:navlist.item>
                    <flux:navlist.item icon="arrow-down-tray" :href="route('backup')" :current="request()->routeIs('backup')" wire:navigate>{{ __('Backup') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
