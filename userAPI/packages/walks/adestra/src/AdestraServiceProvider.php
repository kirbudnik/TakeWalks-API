<?php

namespace Walks\Adestra;

use Illuminate\Support\ServiceProvider;

use Log;

class AdestraServiceProvider extends ServiceProvider
{
    protected $commands = [];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
