<?php

use OiLab\OiLaravelNotes\Data\NoteData;
use OiLab\OiLaravelNotes\Tests\Fixtures\User;

it('builds note data from an array', function () {
    $data = NoteData::from([
        'message' => 'Customer called to confirm the address.',
        'has_bot' => true,
        'user_id' => 7,
    ]);

    expect($data)->toBeInstanceOf(NoteData::class)
        ->and($data->message)->toBe('Customer called to confirm the address.')
        ->and($data->has_bot)->toBeTrue()
        ->and($data->user_id)->toBe(7)
        ->and($data->id)->toBeNull()
        ->and($data->notable_type)->toBeNull();
});

it('builds note data from a model', function () {
    $user = User::factory()->create();
    $note = $user->notes()->create(['message' => 'Signed delivery slip attached.']);

    $data = $note->toData();

    expect($data)->toBeInstanceOf(NoteData::class)
        ->and($data->id)->toBe($note->id)
        ->and($data->uuid)->toBe($note->uuid)
        ->and($data->message)->toBe('Signed delivery slip attached.')
        ->and($data->notable_type)->toBe($user->getMorphClass())
        ->and($data->notable_id)->toBe($user->id)
        ->and($data->has_bot)->toBeFalse();
});

it('defaults has_bot to false', function () {
    $data = new NoteData(message: 'Only a message');

    expect($data->has_bot)->toBeFalse()
        ->and($data->user_id)->toBeNull();
});
