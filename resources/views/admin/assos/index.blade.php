<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Associations') }}
        </h2>
    </x-slot>
    <div class="container mt-4 mx-auto" style="overflow-x: auto;">
        {{-- <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition mb-4" href="{{ route('assos.createAdmin') }}">Ajouter une association</a> --}}
        <livewire:asso-table />
    </div>
</x-app-layout>
