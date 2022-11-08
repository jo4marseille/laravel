<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier ou Créer Associations') }}
        </h2>
    </x-slot>
    <div class="container mt-4 mx-auto">
        <livewire:asso-form :assoId="$assoId" />
    </div>
</x-app-layout>