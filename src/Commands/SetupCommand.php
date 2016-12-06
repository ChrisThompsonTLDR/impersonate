<?php

namespace Christhompsontldr\Impersonate;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'impersonate:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Impersonate: publish config and add trait to user model.';

    /**
     * Commands to call with their description
     *
     * @var array
     */
    protected $calls = [
        'impersonate:publish' => 'Publish the config',
        'impersonate:add-trait'  => 'Add Impersonate trait to user model.',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        foreach ($this->calls as $command => $info) {
            $this->line(PHP_EOL . $info);
            $this->call($command);
        }
    }
}