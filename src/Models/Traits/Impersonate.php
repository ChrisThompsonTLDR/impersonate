<?php
namespace Christhompsontldr\Impersonate\Models\Traits;

trait Impersonate
{

    /**
     * Start impersonating this user
     *
     * @param mixed $id
     */
    public function startImpersonating($id)
    {
        session()->put('impersonate', $id);
    }

    /**
     * Stop impersonating
     *
     * @param mixed $id
     */
    public function stopImpersonating()
    {
        session()->forget('impersonate');
    }

    /**
     * Current impersonating
     *
     * @param mixed $id
     */
    public function isImpersonating()
    {
        return session()->has('impersonate');
    }

    /**
     * Logic for checking if the current user can impersonate the user id.
     *
     * @param mixed $id
     */
    public function canImperonsate($id)
    {
        return true;
    }
}