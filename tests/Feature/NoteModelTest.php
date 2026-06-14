<?php

use OiLab\OiLaravelNotes\Models\Note;
use OiLab\OiLaravelNotes\Tests\Fixtures\User;

it('auto-generates a uuid on creation', function () {
    $note = Note::factory()->create();

    expect($note->uuid)->toBeString()->not->toBeEmpty();
});

it('does not overwrite an explicitly provided uuid', function () {
    $note = Note::factory()->create(['uuid' => 'fixed-uuid']);

    expect($note->uuid)->toBe('fixed-uuid');
});

it('casts has_bot to a boolean', function () {
    $note = Note::factory()->byBot()->create();

    expect($note->has_bot)->toBeTrue()
        ->and($note->user_id)->toBeNull();
});

it('soft deletes notes', function () {
    $note = Note::factory()->create();

    $note->delete();

    expect(Note::count())->toBe(0)
        ->and(Note::withTrashed()->count())->toBe(1);

    $note->restore();

    expect(Note::count())->toBe(1);
});

it('belongs to an author', function () {
    $user = User::factory()->create();

    $note = Note::factory()->forNotable($user)->create(['user_id' => $user->id]);

    expect($note->user)->toBeInstanceOf(User::class);
});
