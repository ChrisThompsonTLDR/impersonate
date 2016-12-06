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
    protected $signature = 'impersonate:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the config';

    public function handle()
    {
        // publish configs
        $this->call('vendor:publish', ['--tag' => 'impersonateconfig']);
    }
}