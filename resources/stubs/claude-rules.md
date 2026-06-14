# Laravel Notes

Use the `oi-laravel-notes` package to attach polymorphic notes to any Eloquent model via the `HasNotes` trait.
Notes carry a `message`, an optional author (user), a `has_bot` flag for machine-generated notes, and can hold
file attachments through the `oi-laravel-attachments` package. Resolve model classes through `OiNotes` so config
overrides apply.

- IMPORTANT: Activate `oilab-laravel-notes` when working with notes, comments, annotations, or activity logs
  attached to models in this Laravel application.
