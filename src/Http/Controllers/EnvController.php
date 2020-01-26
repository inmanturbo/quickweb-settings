<?php

/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 19.07.16
 * Time: 06:17
 */

namespace Quickweb\DotenvEditor\Http\Controllers;

use Quickweb\DotenvEditor\DotenvEditor as Env;
use Quickweb\DotenvEditor\Exceptions\DotEnvException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class EnvController extends BaseController
{

    public function setConfig()
    {
        return new Env('dotenveditor');
    }

    /**
     * Shows the overview, where you can visually edit your .env-file.
     *
     * @param Request $request request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overview(Request $request)
    {
        $env = $this->setConfig();

        $data['values'] = $env->getContent();

        try {

            $data['backups'] = $env->getBackupVersions();
        } catch (DotEnvException $e) {
            $data['backups'] = false;
        }

        $data['url'] = $request->path();
        return view(config($env->config . '.overview'), $data);
    }

    /**
     * Adds a new entry to your .env-file.
     *
     * @param Request $request request
     *
     * @return none
     */
    public function add(Request $request)
    {

        $env = $this->setConfig();
        $env->addData(
            [
                $request->key => $request->value,
            ]
        );
        return response()->json([]);
    }

    /**
     * Updates the given entry from your .env.
     *
     * @param Request $request request
     *
     * @return void
     */
    public function update(Request $request)
    {
        $env = $this->setConfig();
        $env->changeEnv(
            [
                $request->key => $request->value,
            ]
        );
        return response()->json([]);
    }

    /**
     * Returns the content as JSON
     *
     * @param null $timestamp timespamp
     *
     * @return string
     */
    public function getDetails($timestamp = null)
    {
        $env = $this->setConfig();
        return $env->getAsJson($timestamp);
    }

    /**
     * Deletes the given entry from your .env-file
     *
     * @param Request $request request
     *
     * @return void
     */
    public function delete(Request $request)
    {
        $env = $this->setConfig();
        $env->deleteData([$request->key]);
    }
}
