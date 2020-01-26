<?php

namespace Quickweb\DotenvEditor\Http\Controllers;

use Quickweb\SettingsEditor\DotenvEditor as Env;
use Quickweb\SettingsEditor\Exceptions\DotEnvException;
use Illuminate\Http\Request;

class SettingsController extends EnvController
{

    public function setConfig()
    {
        return new Env('settingseditor');
    }
}
