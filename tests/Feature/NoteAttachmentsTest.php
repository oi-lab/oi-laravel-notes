<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use OiLab\OiLaravelAttachments\Actions\AttachUploadedFiles;
use OiLab\OiLaravelNotes\Models\Note;
use OiLab\OiLaravelNotes\Tests\Fixtures\User;

it('attaches uploaded files to a note', function () {
    Storage::fake('local');

    $user = User::factory()->create();
    $note = Note::factory()->forNotable($user)->create();

    AttachUploadedFiles::handle($note, [
        UploadedFile::fake()->create('slip.pdf', 20),
    ]);

    expect($note->refresh()->attached_files)->toHaveCount(1);
});

it('starts with no attachments', function () {
    $note = Note::factory()->create();

    expect($note->attached_files)->toHaveCount(0);
});
