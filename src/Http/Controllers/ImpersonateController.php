<?php

namespace Christhompsontldr\Impersonate\Http\Controllers;

use App\Http\Controllers\Controller;
use Christhompsontldr\Impersonate\Events\ImpersonatingStart;
use Christhompsontldr\Impersonate\Events\ImpersonatingStop;

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
            $realUser = auth()->user();

            auth()->user()->startImpersonating($user->id);

            session()->flash(config('impersonate.flash.success', 'success'), 'Impersonation started.');

            event(new ImpersonatingStart($realUser, $user));

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
        $user = auth()->user();

        auth()->user()->stopImpersonating();

        $realUser = auth()->user();

        session()->flash(config('impersonate.flash.success', 'success'), 'Impersonation ended.');

        event(new ImpersonatingStart($realUser, $user));

        return redirect()->to(config('impersonate.routes.afterStop', '/'));
    }
}
