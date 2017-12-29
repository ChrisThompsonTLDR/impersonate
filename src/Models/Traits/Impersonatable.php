<?php

namespace Christhompsontldr\Impersonate\Models\Traits;

trait Impersonatable
{

    /**
     * Start impersonating this user
     *
     * @param integer $id user.id to impersonate
     */
    public function startImpersonating($id)
    {
        session()->put('impersonate', $id);
    }

    /**
     * Stop impersonating
     */
    public function stopImpersonating()
    {
        session()->forget('impersonate');
    }

    /**
     * Is the user currently impersonating another user
     */
    public function isImpersonating()
    {
        return session()->has('impersonate');
    }

    /**
     * Logic for checking if the current user can impersonate the user id.
     *
     * @param integer $id user.id of the user the logged in user wants to impersonate
     */
    public function canImpersonate($id)
    {
        return false;
    }
}