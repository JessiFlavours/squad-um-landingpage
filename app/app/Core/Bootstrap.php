<?php

namespace App\Core;

use App\Core\Router;
use Symfony\Component\HttpFoundation\Request;
use Dotenv\Dotenv;

class Bootstrap
{
    public function run(): void
    {
        $request = Request::createFromGlobals();
        $this->environmentConfigure();
        $this->configure();
        $this->callRouter($request);
    }

    private function configure()
    {
        $this->initConfigure();
        $this->timezoneConfigure();
    }

    private function initConfigure()
    {
        ini_set('display_errors', '1');
        ini_set('default_charset', 'UTF-8');
    }

    private function timezoneConfigure()
    {
        date_default_timezone_set(config('app.timezone', 'UTC'));
    }

    private function callRouter(Request $request)
    {
        $router = new Router();
        require_once __DIR__ . '/../../routes/api.php';
        $router->dispatch($request);
    }

    private function environmentConfigure()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }
}