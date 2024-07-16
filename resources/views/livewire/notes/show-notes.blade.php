<?php

use Livewire\Volt\Component;
use App\Models\Note;
use Illuminate\Database\Eloquent\ModelNotFoundException;

new class extends Component {
    public function with(): array
    {
        return [
            'notes' => auth()->user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }

    public function delete($noteID)
    {
        try {
            $note = Note::findOrFail($noteID);
            $this->authorize('delete', $note);
            $note->delete();
        } catch (ModelNotFoundException $e) {
            dd($e->getMessage());
        }
    }
}; ?>

<div>
    @if ($notes->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">No notes yet.</p>
            <p class="text-sm">Let's create your first note to send.</p>
            <x-button primary icon-right="plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>Create
                note</x-button>
        </div>
    @else
        <x-button primary icon-right="plus" class="" href="{{ route('notes.create') }}" wire:navigate>Create
            note</x-button>
        <div class="grid grid-cols-2 gap-4 mt-4">
            @foreach ($notes as $note)
                <x-card wire:key='{{ $note->id }}' class="">
                    <div class="flex items-start justify-between">
                        <div class="space-y-2">
                            @can('update', $note)
                                <a href="{{ route('notes.edit', $note) }}"
                                    class="text-xl font-bold hover:underline hover:text-blue-500 ">{{ $note->title }}</a>
                            @else
                                <p class="text-xl font-bold text-gray-500">{{ $note->title }}</p>
                            @endcan
                            <p class="text-xs">{{ Str::limit($note->body, 30) }}</p>
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}
                        </div>
                    </div>
                    <div class="flex items-end justify-between mt-4 space-x-1">
                        <p class="text-xs">Recipient: <span class="font-semibold ">{{ $note->recipient }}</span>
                        </p>
                        <div>
                            <x-button rounded white icon="eye" href="{{ route('notes.view', ['note' => $note]) }}"
                                wire:navigate></x-button>
                            <x-button wire:click="delete('{{ $note->id }}')" rounded white
                                icon="trash"></x-button>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif
</div>
