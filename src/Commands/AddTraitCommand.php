<?php

namespace Christhompsontldr\Impersonate;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Christhompsontldr\Impersonate\Models\Traits\Impersonate;
use Traitor\Traitor;

class AddTraitCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'inpersonate:add-trait';

    /**
     * Trait added to User model
     *
     * @var string
     */
    protected $targetTrait = Impersonate::class;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $userModel = $this->getUserModel();

        if (! class_exists($userModel)) {
            $this->error("Class $userModel does not exist.");
            return;
        }

        if ($this->exists()) {
            $this->error("Class $userModel already uses Impersonate trait.");
            return;
        }

        Traitor::addTrait($this->targetTrait)->toClass($userModel);

        $this->info("Impersonate trait added successfully");
    }

    /**
     * @return bool
     */
    protected function exists()
    {
        return in_array($this->targetTrait, class_uses($this->getUserModel()));
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return "Add Impersonate trait to {$this->getUserModel()} class.";
    }

    /**
     * @return string
     */
    protected function getUserModel()
    {
        return config('auth.providers.users.model', 'App\User');
    }
}