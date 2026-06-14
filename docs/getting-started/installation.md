---
title: Installation
description: How to install OI Laravel Notes via Composer
section: getting-started
order: 2
---

# Installation

## Via Composer

```bash
composer require oi-lab/oi-laravel-notes
```

The package auto-discovers and registers its service provider via Laravel's package discovery — no manual
registration required. It depends on `oi-lab/oi-laravel-attachments`, which is installed automatically.

## Publish the migrations

The package ships the `notes` migration. It is loaded automatically from the package, so `php artisan migrate`
works even without publishing. Publish it only when you need to customize the schema:

```bash
php artisan vendor:publish --tag=oi-laravel-notes-migrations
php artisan migrate
```

## Publish the configuration (optional)

```bash
php artisan vendor:publish --tag=oi-laravel-notes-config
```

This creates `config/oi-laravel-notes.php` with sensible defaults. See
[Configuration](../configuration/configuration.md) for all available options.

## Local development

To use the package from a local checkout alongside your project, add a `path` repository to your project's
`composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "./packages/oi-lab/oi-laravel-notes"
        }
    ]
}
```

Then `composer require oi-lab/oi-laravel-notes`.
