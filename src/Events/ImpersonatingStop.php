<?php

namespace Christhompsontldr\Impersonate\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class ImpersonatingStop
{
    use SerializesModels;

    /**
     * The real user
     *
     * @var User
     */
    public $realUser;

    /**
     * The user being impersonated
     *
     * @var User
     */
    public $impersonatedUser;

    /**
     * Create a new event instance.
     *
     * @param User $realUser the user that is impersonating
     * @param User $impersonatedUser the user being impersonated
     *
     * @return void
     */
    public function __construct(User $realUser, User $impersonatedUser)
    {
        $this->realUser = $realUser;

        $this->impersonatedUser = $impersonatedUser;
    }
}
