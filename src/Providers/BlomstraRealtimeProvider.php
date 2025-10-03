<?php

namespace Xelson\Chat\Providers;

use Flarum\Foundation\AbstractServiceProvider;

class BlomstraRealtimeProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->app->singleton('xelson-chat.realtime', function ($app) {
            return $app['blomstra.realtime'];
        });
    }
}
