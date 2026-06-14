---
title: Introduction
description: Discover OI Laravel Notes and what it can do for your project
section: getting-started
order: 1
---

# OI Laravel Notes

OI Laravel Notes adds polymorphic notes to any Eloquent model. Instead of building a bespoke `*_notes` table
for every model that needs comments or annotations, you add a single trait and gain a `notes()` relationship —
backed by a `Note` model that can be authored by a user, flagged as machine-generated, and enriched with file
attachments.

## Why use this package?

Many apps need "this record can have notes": order notes, customer comments, system activity entries. Rolling
that by hand means a table, polymorphism, an author relationship, and file handling — repeated everywhere. This
package centralizes all of it:

- One `HasNotes` trait makes **any** model notable.
- Each note has an optional **author** (configurable user model).
- A `has_bot` flag distinguishes **system-generated** notes from user notes.
- Notes are **attachable** — attach files via `oi-laravel-attachments`.
- Notes carry a `uuid` and are **soft-deletable**.

## What it looks like

```php
use OiLab\OiLaravelNotes\Concerns\HasNotes;

class Order extends Model
{
    use HasNotes;
}

$order->notes()->create([
    'message' => 'Customer called to confirm the address.',
    'user_id' => auth()->id(),
]);

$order->notes; // Collection<Note>
```

## Requirements

- PHP 8.2+
- Laravel 11, 12, or 13
- `oi-lab/oi-laravel-attachments` ^1.0

## Next steps

Follow the [Installation](installation.md) guide to add the package to your project.
