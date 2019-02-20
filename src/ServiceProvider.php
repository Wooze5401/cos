<?php

/*
 * This file is part of the overtrue/weather.
 *
 * (c) wooze
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE
 */

namespace Wooze\Cos;

use Wooze\Cos\Commands\CosUpload;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/cos.php' => config_path('cos.php'),
        ], 'cos');
    }

    public function register()
    {
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        $this->commands([
            CosUpload::class,
        ]);
    }
}
