<?php

namespace Christhompsontldr\Impersonate\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;

class MembershipController extends Controller
{
    public function start($id)
    {
        // valid user
        $userModel = config('auth.providers.users.model', 'App\User');

        $user = $userModel::firstOrFail($id);

        if ($user && Auth::user()->canImpersonate($id)) {
            Auth::user()->startImpersonating($user->id);
        } else {
            session()->flash(config('impersonate.flash.error', 'error'), 'You can not impersonate that user.');
        }

        return redirect()->to(config('impersonate.routes.afterStart', '/'));
    }

    public function stop()
    {
        Auth::user()->stopImpersonating();

        session()->flash(config('impersonate.flash.success', 'success'), 'Impersonation ended.');

        return redirect()->to(config('impersonate.routes.afterStart', '/'));
    }
}
