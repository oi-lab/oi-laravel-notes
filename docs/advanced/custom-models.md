---
title: Custom Models
description: Overriding the Note model and user model
section: advanced
order: 1
---

# Custom Models

Every model the package uses is resolved through the `OiNotes` resolver, never referenced directly. This lets
host applications swap in their own subclasses from config.

## Overriding the Note model

Extend the base `Note` model and register it:

```php
namespace App\Models;

use OiLab\OiLaravelNotes\Models\Note as BaseNote;

class Note extends BaseNote
{
    // your customizations
}
```

```php
// config/oi-laravel-notes.php
'models' => [
    'note' => App\Models\Note::class,
],
```

The `HasNotes` trait, the factory, and all internals now resolve your subclass via
`OiNotes::noteModel()`.

## Overriding the user model

```php
// config/oi-laravel-notes.php
'user_model' => App\Models\Account::class,
```

The `Note::user()` relationship resolves the configured class through `OiNotes::userModel()`.

## The resolver

```php
use OiLab\OiLaravelNotes\OiNotes;

OiNotes::noteModel(); // configured Note class
OiNotes::userModel(); // configured user class
```

Always go through these helpers in your own code instead of referencing `Note::class` directly, so config
overrides keep working.
