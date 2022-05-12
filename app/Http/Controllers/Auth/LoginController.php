<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LoggedIn;
use App\Models\Loggedout;
use Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web')->except('logout');
    }

    public function credentials(Request $request)
    {
        return [
            'email'     => $request->email,
            'password'  => $request->password,
            'delete_at' => null
        ];

    }

    protected function authenticated(Request $request, $user)
    {
        // $date = Carbon::now()->setTimezone('Asia/Bangkok');
        // $date->toArray();
        // $user->authenticated_at = $date->toTimeString();

        // $user->save();
        $loggedin = LoggedIn::create([
            'user_id' => $user->id,
        ]);

        return redirect()->intended($this->redirectPath());
    }

    protected function logout(Request $request) {
        $user = Auth::user();
        Auth::logout();
        $loggedout = Loggedout::create([
            'user_id' => $user->id,
        ]);
        // $date = Carbon::now()->setTimezone('Asia/Bangkok');
        // $date->toArray();
        // $user->authenticated_out = $date->toTimeString();
        // $user->save();
        
        return redirect('/login');
    }
}
