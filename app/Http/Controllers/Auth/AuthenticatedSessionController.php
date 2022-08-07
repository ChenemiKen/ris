<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Session;
use Spatie\Valuestore\Valuestore;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        Log::debug(settings()->get('parent_access'));
        if(!settings()->get('parent_access')){
            if(!((Auth::user()->type_type) == "App\\Models\\Admin" || (Auth::user()->type_type) == "App\\Models\\Teacher")){
                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return view('no-parent-access');
            }
        }
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Enable or disable parent login
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function parentAccess(Request $request){
        $settings = Valuestore::make(storage_path('app/settings.json'));
        $parentLogin = $request->parentLogin == 'true' ? true : false;
        
        $settings->put('parent_access', $parentLogin);

        if($parentLogin){
            Session::flash('info', "Parent Access Enabled");
        }else{
            Session::flash('info', "Parent Access Disabled");
        }
        
        return redirect()->back();
    }  
}
