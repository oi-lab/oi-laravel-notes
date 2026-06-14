<?php

namespace OiLab\OiLaravelNotes\Observers;

use Illuminate\Support\Str;
use OiLab\OiLaravelNotes\Models\Note;

class NoteObserver
{
    /**
     * Handle the Note "creating" event.
     */
    public function creating(Note $note): void
    {
        if (! $note->uuid) {
            $note->uuid = (string) Str::uuid();
        }
    }
}
