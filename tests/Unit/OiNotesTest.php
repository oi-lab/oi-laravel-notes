<?php

use OiLab\OiLaravelNotes\Models\Note;
use OiLab\OiLaravelNotes\OiNotes;
use OiLab\OiLaravelNotes\Tests\Fixtures\User;

it('resolves the configured note model', function () {
    expect(OiNotes::noteModel())->toBe(Note::class);
});

it('resolves the configured user model', function () {
    expect(OiNotes::userModel())->toBe(User::class);
});

it('honours a custom note model from config', function () {
    config()->set('oi-laravel-notes.models.note', 'App\\Models\\CustomNote');

    expect(OiNotes::noteModel())->toBe('App\\Models\\CustomNote');
});

it('honours a custom user model from config', function () {
    config()->set('oi-laravel-notes.user_model', 'App\\Models\\Account');

    expect(OiNotes::userModel())->toBe('App\\Models\\Account');
});
