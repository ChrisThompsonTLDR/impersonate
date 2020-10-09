<?php

namespace Christhompsontldr\Impersonate\Models\Traits;

use App\Models\User;
use Christhompsontldr\Impersonate\Events\ImpersonatingStart;
use Christhompsontldr\Impersonate\Events\ImpersonatingStop;

trait Impersonatable
{

    /**
     * Start impersonating this user
     *
     * @param User $user the user that is being impersonated
     *
     * @return void
     */
    public function startImpersonating(User $user): void
    {
        session()->put('impersonate', $user->id);

        event(new ImpersonatingStart(auth()->user(), $user));
    }

    /**
     * Stop impersonating
     *
     * @return void
     */
    public function stopImpersonating(): void
    {
        if ($user = User::find(session()->pull('impersonate'))) {
            event(new ImpersonatingStop(auth()->user(), $user));
        }
    }

    /**
     * Is the user currently impersonating another user
     *
     * @return void
     */
    public function isImpersonating(): bool
    {
        return session()->has('impersonate');
    }

    /**
     * Logic for checking if the logged in user can impersonate another user
     *
     * @param User $user the user that is about to be impersonated
     *
     * @return bool
     */
    public function canImpersonate(User $user): bool
    {
        return false;
    }
}
