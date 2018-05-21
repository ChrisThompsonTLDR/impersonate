<?php

namespace Christhompsontldr\Impersonate\Events;

use Illuminate\Queue\SerializesModels;

class ImpersonatingStart
{
    use SerializesModels;

    /**
     * The real user
     *
     * @var mixed
     */
    public $realUser;

    /**
     * The user being impersonated
     *
     * @var mixed
     */
    public $impersonatedUser;

    /**
     * Create a new event instance.
     *
     * @param Request $request
     * @return void
     */
    public function __construct($realUser, $impersonatedUser)
    {
        $this->realUser = $realUser;
        $this->impersonatedUser = $impersonatedUser;
    }
}