<?php

namespace OiLab\OiLaravelNotes;

/**
 * OiNotes
 *
 * Central resolver for the configurable model classes used across the package.
 * Package internals (models, traits, factories) resolve their collaborators
 * through these helpers so host applications can swap in their own classes
 * via config.
 */
class OiNotes
{
    /**
     * Resolve the configured Note model class.
     *
     * @return class-string
     */
    public static function noteModel(): string
    {
        return config('oi-laravel-notes.models.note', Models\Note::class);
    }

    /**
     * Resolve the configured User model class.
     *
     * @return class-string
     */
    public static function userModel(): string
    {
        return config('oi-laravel-notes.user_model', 'App\Models\User');
    }
}
