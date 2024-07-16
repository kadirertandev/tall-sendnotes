<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;

    public function mount(Note $note)
    {
        $this->note = $note;
    }

    public function increment()
    {
        $this->note->increment('heart_count', 1);
    }
}; ?>

<div>
    <x-button xs wire:click='increment' rose icon='heart' spinner>{{ $note->heart_count }}</x-button>
</div>
