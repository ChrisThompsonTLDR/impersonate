<?php

namespace Christhompsontldr\Impersonate\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'inpersonate:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the config';

    public function handle()
    {
        // publish configs
        $this->publishes([
           realpath(dirname(__DIR__)) . '/config/impersonate.php' => config_path('impersonate.php'),
        ]);
    }
}