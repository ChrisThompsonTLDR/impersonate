<?php

namespace Christhompsontldr\Impersonate\Http\Controllers;

use App\Http\Controllers\Controller;

class ImpersonateController extends Controller
{

    /**
     * Action to begin impersonation
     *
     * @param integer $id user.id that will be impersonated
     */
    public function start($id)
    {
        // valid user
        $userModel = config('auth.providers.users.model', 'App\User');

        $user = $userModel::findOrFail($id);

        //  successful
        if ($user && auth()->user()->canImpersonate($id)) {
            auth()->user()->startImpersonating($user->id);

            session()->flash(config('impersonate.flash.success', 'success'), 'Impersonation started.');

            return redirect()->to(config('impersonate.routes.afterStart', '/'));
        }

        session()->flash(config('impersonate.flash.error', 'error'), 'You can not impersonate that user.');

        return redirect()->back();
    }

    /**
     * Action to end impersonation
     *
     */
    public function stop()
    {
        auth()->user()->stopImpersonating();

        session()->flash(config('impersonate.flash.success', 'success'), 'Impersonation ended.');

        return redirect()->to(config('impersonate.routes.afterStop', '/'));
    }
}
