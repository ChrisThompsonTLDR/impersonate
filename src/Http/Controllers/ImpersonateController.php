<?php

namespace Christhompsontldr\Impersonate\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Christhompsontldr\Impersonate\Events\ImpersonatingStart;
use Christhompsontldr\Impersonate\Events\ImpersonatingStop;

class ImpersonateController extends Controller
{

    /**
     * Action to begin impersonation
     *
     * @param integer $id user.id that will be impersonated
     */
    public function start(User $user)
    {
        if (!auth()->user()->canImpersonate($user)) {
            return back()
                ->withError('You can not impersonate that user.');
        }

        auth()->user()->startImpersonating($user);

        return redirect()
            ->to(config('impersonate.routes.afterStart', '/'))
            ->withSuccess('Impersonation started.');
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
