<flux:navbar>
    <flux:navbar.item :href="route('hotels')" :current="request()->routeIs('hotels')">Hotels</flux:navbar.item>
    <flux:navbar.item :href="route('departments')" :current="request()->routeIs('departments')">Departments</flux:navbar.item>
    <flux:navbar.item href="#">Villas</flux:navbar.item>
    <flux:navbar.item href="#">Rooms</flux:navbar.item>
</flux:navbar>