<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use OiLab\OiLaravelNotes\Http\Requests\NoteRequest;

function noteValidator(array $data): Illuminate\Validation\Validator
{
    return Validator::make($data, (new NoteRequest)->rules());
}

it('requires a message', function () {
    expect(noteValidator(['message' => ''])->passes())->toBeFalse();
    expect(noteValidator(['message' => 'Hello'])->passes())->toBeTrue();
});

it('accepts files within the configured limits', function () {
    $files = [UploadedFile::fake()->create('a.pdf', 100)];

    expect(noteValidator(['message' => 'x', 'files' => $files])->passes())->toBeTrue();
});

it('rejects more files than the configured maximum', function () {
    config()->set('oi-laravel-notes.attachments.max_files', 1);

    $files = [
        UploadedFile::fake()->create('a.pdf', 10),
        UploadedFile::fake()->create('b.pdf', 10),
    ];

    expect(noteValidator(['message' => 'x', 'files' => $files])->passes())->toBeFalse();
});

it('rejects files larger than the configured size', function () {
    config()->set('oi-laravel-notes.attachments.max_file_size', 1);

    $files = [UploadedFile::fake()->create('big.pdf', 50)];

    expect(noteValidator(['message' => 'x', 'files' => $files])->passes())->toBeFalse();
});
