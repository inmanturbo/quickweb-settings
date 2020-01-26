<?php

namespace Quickweb\SettingsEditor;

use Illuminate\Support\ServiceProvider;

class SettingsEditorServiceProvider extends ServiceProvider
{
    /**
     * Provider boot
     *
     * @return null
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/../resources/views' => resource_path('views/vendor/dotenv-editor'),
            ],
            'views'
        );

        $this->publishes(
            [
                __DIR__ . '/../config/dotenveditor.php' => config_path('dotenveditor.php'),
                __DIR__ . '/../config/settings.php' => config_path('settings.php'),
                __DIR__ . '/../config/settingseditor.php' => config_path('settingseditor.php'),
                __DIR__ . '/../config/settings.txt' => config_path('settings.txt'),
            ],
            'config'
        );

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dotenv-editor');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'dotenv-editor');
    }

    /**
     * Provider register
     *
     * @return null
     */
    public function register()
    {
        $this->app->bind(
            'quickweb-dotenveditor',
            function () {
                return new DotenvEditor();
            }
        );

        $this->mergeConfigFrom(__DIR__ . '/../config/dotenveditor.php', 'dotenveditor');
        $this->mergeConfigFrom(__DIR__ . '/../config/settings.php', 'settings');
        $this->mergeConfigFrom(__DIR__ . '/../config/settingseditor.php', 'settingseditor');
        //copy(__DIR__ . '/../config/settings.stub', base_path('config/settings.stub'));
    }
}
