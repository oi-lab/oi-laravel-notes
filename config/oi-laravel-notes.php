<?php

use OiLab\OiLaravelNotes\Models\Note;

return [
    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | The model used for the note author relationship.
    |
    */
    'user_model' => 'App\Models\User',

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | The model classes used by the package. Override these with your own
    | classes (extending the package base models) to customize behavior.
    |
    */
    'models' => [
        'note' => Note::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Attachments
    |--------------------------------------------------------------------------
    |
    | Validation constraints applied to files attached to a note. Files are
    | stored through the oi-laravel-attachments package.
    |
    */
    'attachments' => [
        'max_files' => 10,
        'max_file_size' => 10240, // kilobytes
    ],
];
