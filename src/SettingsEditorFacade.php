<?php

namespace Quickweb\SettingsEditor;

use Illuminate\Support\Facades\Facade;

class SettingsEditorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'quickweb-dotenveditor';
    }
}
