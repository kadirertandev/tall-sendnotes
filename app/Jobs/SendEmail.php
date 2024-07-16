<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  private Note $note;
  /**
   * Create a new job instance.
   */
  public function __construct(Note $note)
  {
    $this->note = $note;
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    // $noteURL = route('notes.view', ["note" => $this->note]);
    $noteURL = config("app.url") . ":8000" . "/notes/" . $this->note->id;

    $mailContent = "Hello, you've received a new note. View it here: {$noteURL}";

    Mail::raw($mailContent, function ($message) {
      $message->from("info@sendnotes.com", "SendNotes")
        ->to($this->note->recipient)
        ->subject("You have a new note from " . $this->note->user->name);
    });
  }
}
