---
title: AI Assistant Skills
description: Installing the bundled Claude Code and JetBrains Junie skills
section: advanced
order: 2
---

# AI Assistant Skills

The package ships an AI context skill describing how to use it. Install the skill files into your application:

```bash
php artisan oi:install-ai-skill
```

This command:

- writes `SKILL.md` to `.claude/skills/oilab-laravel-notes/` (Claude Code) and
  `.junie/skills/oilab-laravel-notes/` (JetBrains Junie);
- adds (or refreshes) an `=== oi-lab/oi-laravel-notes rules ===` section in your project's `CLAUDE.md`.

The canonical source is `resources/stubs/ai-skill.md`. After changing the package, maintainers re-sync the
committed skill copies with:

```bash
composer sync-ai-skills
```

This also runs automatically on `post-autoload-dump`.
