---
title: Configuration
description: All available configuration options for OI Laravel Notes
section: configuration
order: 1
---

# Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=oi-laravel-notes-config
```

This creates `config/oi-laravel-notes.php`:

```php
return [
    'user_model' => 'App\Models\User',

    'models' => [
        'note' => OiLab\OiLaravelNotes\Models\Note::class,
    ],

    'attachments' => [
        'max_files' => 10,
        'max_file_size' => 10240, // kilobytes
    ],
];
```

## Options

| Key | Default | Description |
|-----|---------|-------------|
| `user_model` | `App\Models\User` | Model used for the note author relationship |
| `models.note` | `Note::class` | Override with your own `Note` subclass |
| `attachments.max_files` | `10` | Maximum number of files accepted by `NoteRequest` |
| `attachments.max_file_size` | `10240` | Maximum per-file size, in kilobytes, accepted by `NoteRequest` |

All model classes are resolved through the `OiNotes` resolver, so overriding `models.note` or `user_model`
propagates everywhere in the package. See [Custom Models](../advanced/custom-models.md).
