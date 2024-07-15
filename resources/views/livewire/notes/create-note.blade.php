<?php

use Livewire\Volt\Component;

new class extends Component {
    public $title;
    public $body;
    public $recipient;
    public $sendDate;

    public function submit()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:5'],
            'body' => ['required', 'string', 'min:20'],
            'recipient' => ['required', 'email'],
            'sendDate' => ['required', 'date'],
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $this->title,
                'body' => $this->body,
                'recipient' => $this->recipient,
                'send_date' => $this->sendDate,
            ]);

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <x-errors class="mb-4" />
    <form wire:submit='submit' class="space-y-4">
        <x-input wire:model='title' label="Title"></x-input>
        <x-textarea wire:model='body' label="Body"></x-textarea>
        <x-input wire:model='recipient' label="Recipient" placeholder="yourfriend@test.com"></x-input>
        <x-input wire:model='sendDate' label="Send Date" type="date" icon="calendar"></x-input>
        <div class="pt-4">
            <x-button primary right-icon="calendar" type="submit" spinner>Schedule Note</x-button>
        </div>
    </form>
</div>
