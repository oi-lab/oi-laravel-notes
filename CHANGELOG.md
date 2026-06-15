# Changelog

All notable changes to `oi-laravel-notes` will be documented in this file.

## [Unreleased]

### Changed
- **AI Assistant Skills**: The skill install command was renamed to `oi-notes:install-ai-skill` and is now **deprecated** in favor of the unified `php artisan oi:skills` command (provided by `oi-lab/oi-laravel-development`), which discovers and installs skills from all installed `oi-lab/*` packages.

## [1.0.0] - 2026-06-14

Initial release of OI Laravel Notes — polymorphic notes with attachments for Laravel applications.

### Core Features
- **Polymorphic Notes**: The `HasNotes` trait makes any Eloquent model annotatable with a `notes()` relationship.
- **Authored & Bot Notes**: Each note has an optional author (configurable user model) and a `has_bot` flag for machine-generated notes.
- **File Attachments**: `Note` uses the `HasAttachments` trait from `oi-laravel-attachments`, so files can be attached to any note.
- **Form Request**: `NoteRequest` validates the message and uploaded files against configurable limits.
- **Configurable Models**: The `Note` and user models are resolved through `OiNotes` and can be swapped via config.
- **UUIDs & Soft Deletes**: Every note carries a unique `uuid` (auto-generated via `NoteObserver`) and is soft-deletable.
- **AI Assistant Skills**: The `oi:install-ai-skill` Artisan command installs Claude Code / JetBrains Junie skill files and a `CLAUDE.md` rules section into the host application.

### Requirements
- PHP 8.2, 8.3, or 8.4
- Laravel 11.0+, 12.0+, or 13.0+
- `oi-lab/oi-laravel-attachments` ^1.0
