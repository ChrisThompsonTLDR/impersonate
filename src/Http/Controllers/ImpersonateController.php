<?php

namespace Christhompsontldr\Impersonate\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;

class ImpersonateController extends Controller
{
    public function start($id)
    {
        // valid user
        $userModel = config('auth.providers.users.model', 'App\User');

        $user = $userModel::findOrFail($id);

        //  successful
        if ($user && Auth::user()->canImpersonate($id)) {
            Auth::user()->startImpersonating($user->id);

            session()->flash(config('impersonate.flash.success', 'success'), 'Impersonation started.');

            return redirect()->to(config('impersonate.routes.afterStart', '/'));
        }

        session()->flash(config('impersonate.flash.error', 'error'), 'You can not impersonate that user.');

        return redirect()->back();
    }

    public function stop()
    {
        auth()->user()->stopImpersonating();

        session()->flash(config('impersonate.flash.success', 'success'), 'Impersonation ended.');

        return redirect()->to(config('impersonate.routes.afterStop', '/'));
    }
}
