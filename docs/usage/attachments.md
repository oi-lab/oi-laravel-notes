---
title: Attachments
description: Attaching files to notes
section: usage
order: 3
---

# Attachments

The `Note` model uses the `HasAttachments` trait from
[`oi-laravel-attachments`](https://packagist.org/packages/oi-lab/oi-laravel-attachments), so any note can
carry files.

## Attaching uploaded files

Use the upload action to store and attach files in one call:

```php
use OiLab\OiLaravelAttachments\Actions\AttachUploadedFiles;

$note = $order->notes()->create(['message' => 'Signed delivery slip attached.']);

AttachUploadedFiles::handle($note, $request->file('files'));
```

## Reading attached files

```php
$note->attached_files; // Collection<File>
$note->attachments;    // the polymorphic Attachment pivots
```

## Validating input

`OiLab\OiLaravelNotes\Http\Requests\NoteRequest` validates both the message and the uploaded files against the
configured limits:

```php
use OiLab\OiLaravelNotes\Http\Requests\NoteRequest;

public function store(NoteRequest $request, Order $order)
{
    $note = $order->notes()->create([
        'message' => $request->validated('message'),
        'user_id' => $request->user()->id,
    ]);

    if ($request->hasFile('files')) {
        AttachUploadedFiles::handle($note, $request->file('files'));
    }

    return $note;
}
```

The `attachments.max_files` and `attachments.max_file_size` config values drive the file validation rules. See
[Configuration](../configuration/configuration.md).
