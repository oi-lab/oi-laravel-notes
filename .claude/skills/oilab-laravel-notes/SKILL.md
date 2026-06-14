# OI Laravel Notes — AI Context

This package provides polymorphic notes for Laravel applications. Any Eloquent model can be annotated with
notes — short messages optionally authored by a user, flagged as bot-generated, and enriched with file
attachments (via `oi-laravel-attachments`).

## Core Concepts

- **Note** — a message attached polymorphically to any `notable` model. Carries a `uuid`, `message`, a
  `has_bot` flag, an optional author (`user_id`), soft deletes, and timestamps. Lives in the `notes` table.
- **HasNotes** — the trait host models use to gain a `notes()` polymorphic relationship.
- **Attachments** — because `Note` uses `HasAttachments`, files can be attached to a note exactly like any
  other attachable model.

## Adding Notes to a Model

Add the trait to any model:

```php
use OiLab\OiLaravelNotes\Concerns\HasNotes;

class Order extends Model
{
    use HasNotes;
}
```

Then read and write notes through the relationship:

```php
$order->notes()->create([
    'message' => 'Customer called to confirm the address.',
    'user_id' => auth()->id(),
]);

$order->notes;            // all notes (MorphMany)
$order->notes()->count();
```

Bot / system notes set `has_bot` and omit the author:

```php
$order->notes()->create([
    'message' => 'Status automatically advanced to shipped.',
    'has_bot' => true,
]);
```

## Attaching Files to a Note

A `Note` is attachable. Use the `oi-laravel-attachments` actions:

```php
use OiLab\OiLaravelAttachments\Actions\AttachUploadedFiles;

$note = $order->notes()->create(['message' => 'Signed delivery slip attached.']);

AttachUploadedFiles::handle($note, $request->file('files'));

$note->attached_files; // Collection of File models
```

## Validating Note Input

`OiLab\OiLaravelNotes\Http\Requests\NoteRequest` ships validation for the message and uploaded files,
respecting the `attachments.max_files` / `attachments.max_file_size` config limits.

## Configuration

Publish the config and migrations:

```bash
php artisan vendor:publish --tag=oi-laravel-notes-config
php artisan vendor:publish --tag=oi-laravel-notes-migrations
php artisan migrate
```

`config/oi-laravel-notes.php` exposes these options:

| Key | Default | Description |
|-----|---------|-------------|
| `user_model` | `App\Models\User` | Model used for the note author relationship |
| `models.note` | `Note::class` | Override with your own Note subclass |
| `attachments.max_files` | `10` | Max files accepted by `NoteRequest` |
| `attachments.max_file_size` | `10240` | Max per-file size (KB) accepted by `NoteRequest` |

Always resolve model classes through `OiNotes` (e.g. `OiNotes::noteModel()`, `OiNotes::userModel()`),
never reference `Note::class` directly, so host-app overrides keep working.

## Conventions

- Notes carry a `uuid` auto-generated via `NoteObserver` on `creating`.
- `Note` uses `SoftDeletes`; deleting a note is reversible.
- The `notable` relationship is polymorphic (`notable_type` / `notable_id`).
- `has_bot` distinguishes machine-generated notes from user-authored ones.

## Updating the AI Skill

After updating this package, re-install the skill files:

```bash
php artisan oi:install-ai-skill
```
