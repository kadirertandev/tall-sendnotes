<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;
use App\Throwable;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public $title;
    public $body;
    public $recipient;
    public $sendDate;
    public $isPublished;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->sendDate = $note->send_date;
        $this->isPublished = $note->is_published;
    }

    public function update()
    {
        try {
            $validated = $this->validate([
                'title' => ['required', 'string', 'min:5'],
                'body' => ['required', 'string', 'min:20'],
                'recipient' => ['required', 'email'],
                'sendDate' => ['required', 'date'],
            ]);

            $this->note->update([
                'title' => $this->title,
                'body' => $this->body,
                'recipient' => $this->recipient,
                'send_date' => $this->sendDate,
                'is_published' => $this->isPublished,
            ]);

            $this->dispatch('note-edit-success');
        } catch (Throwable $e) {
            $this->dispatch('something-went-wrong');
        }
    }
}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Note') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-3xl mx-auto space-y-4 sm:px-6 lg:px-8">
        <form wire:submit='update' class="space-y-4">
            <x-input wire:model='title' label="Title"></x-input>
            <x-textarea wire:model='body' label="Body"></x-textarea>
            <x-input wire:model='recipient' label="Recipient" placeholder="yourfriend@test.com"></x-input>
            <x-input wire:model='sendDate' label="Send Date" type="date" icon="calendar"></x-input>
            <x-checkbox wire:model='isPublished' label="Is Note Published"></x-checkbox>
            <div class="flex items-center justify-between pt-4">
                <x-button secondary type="submit" spinner="update">Save Note</x-button>
                <x-button negative flat href="{{ route('notes.index') }}">Back to Notes</x-button>
            </div>
        </form>
    </div>
</div>
