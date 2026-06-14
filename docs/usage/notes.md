---
title: Notes
description: Creating, reading, authoring, and deleting notes
section: usage
order: 2
---

# Notes

## Creating notes

Create notes through the polymorphic `notes()` relationship:

```php
$order->notes()->create([
    'message' => 'Customer called to confirm the address.',
    'user_id' => auth()->id(),
]);
```

The `uuid` is generated automatically by `NoteObserver` on creation — you never set it by hand.

## Bot / system notes

Set `has_bot` to flag a note as machine-generated and omit the author:

```php
$order->notes()->create([
    'message' => 'Status automatically advanced to shipped.',
    'has_bot' => true,
]);
```

## Reading notes

```php
$order->notes;                       // all notes (MorphMany)
$order->notes()->latest()->first();  // most recent
$order->notes()->where('has_bot', false)->get(); // user notes only
```

## The author relationship

Each note belongs to the configured user model:

```php
$note->user; // the authoring user (or null for bot notes)
```

## Soft deletes

Notes use `SoftDeletes`, so deletion is reversible:

```php
$note->delete();
$note->restore();
$order->notes()->withTrashed()->get();
```

## Factory

A factory ships for tests and seeders:

```php
use OiLab\OiLaravelNotes\Models\Note;

Note::factory()->forNotable($order)->create();
Note::factory()->byBot()->forNotable($order)->create();
```
