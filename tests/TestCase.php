<?php

namespace OiLab\OiLaravelNotes\Tests;

use Illuminate\Foundation\Application;
use OiLab\OiLaravelAttachments\OiLaravelAttachmentsServiceProvider;
use OiLab\OiLaravelNotes\OiLaravelNotesServiceProvider;
use OiLab\OiLaravelNotes\Tests\Fixtures\User;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @param  Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            OiLaravelAttachmentsServiceProvider::class,
            OiLaravelNotesServiceProvider::class,
        ];
    }

    /**
     * @param  Application  $app
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        $app['config']->set('oi-laravel-notes.user_model', User::class);
        $app['config']->set('oi-laravel-attachments.user_model', User::class);
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Fixtures/database/migrations');
    }
}
