<?php

use OiLab\OiLaravelNotes\Models\Note;
use OiLab\OiLaravelNotes\Tests\Fixtures\User;

it('exposes a polymorphic notes relationship', function () {
    $user = User::factory()->create();

    $note = $user->notes()->create([
        'message' => 'A first note.',
        'user_id' => $user->id,
    ]);

    expect($user->notes)->toHaveCount(1)
        ->and($user->notes->first()->is($note))->toBeTrue()
        ->and($note->notable->is($user))->toBeTrue();
});

it('only returns notes for the owning model', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    Note::factory()->forNotable($owner)->count(2)->create();
    Note::factory()->forNotable($other)->create();

    expect($owner->notes)->toHaveCount(2)
        ->and($other->notes)->toHaveCount(1);
});

it('resolves the author through the user relationship', function () {
    $author = User::factory()->create();

    $note = Note::factory()->forNotable($author)->create(['user_id' => $author->id]);

    expect($note->user->is($author))->toBeTrue();
});
