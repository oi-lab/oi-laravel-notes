---
title: Usage Overview
description: How to add notes to your models
section: usage
order: 1
---

# Usage Overview

Add the `HasNotes` trait to any model to make it notable, then create and read notes through the `notes()`
relationship.

- [Notes](notes.md) — create, read, author, and soft-delete notes.
- [Attachments](attachments.md) — attach files to a note.

```php
use OiLab\OiLaravelNotes\Concerns\HasNotes;

class Order extends Model
{
    use HasNotes;
}
```
