<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create a Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto space-y-4 sm:px-6 lg:px-8">
            <x-button icon="arrow-left" href="{{ route('notes.index') }}" wire:navigate>All Notes</x-button>
            <livewire:notes.create-note />
        </div>
    </div>
</x-app-layout>
