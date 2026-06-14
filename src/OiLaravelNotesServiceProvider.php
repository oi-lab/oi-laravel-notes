<?php

namespace OiLab\OiLaravelNotes;

use Illuminate\Support\ServiceProvider;
use OiLab\OiLaravelNotes\Console\Commands\InstallAiSkillCommand;

class OiLaravelNotesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/oi-laravel-notes.php', 'oi-laravel-notes');
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallAiSkillCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/oi-laravel-notes.php' => config_path('oi-laravel-notes.php'),
            ], 'oi-laravel-notes-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'oi-laravel-notes-migrations');

            $this->publishes([
                __DIR__.'/../resources/stubs/ai-skill.md' => base_path('.claude/skills/oilab-laravel-notes/SKILL.md'),
            ], 'oi-laravel-notes-skill');
        }
    }
}
