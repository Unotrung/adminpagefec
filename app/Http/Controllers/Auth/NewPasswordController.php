<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserInfo; 
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Mail;
use Session;
use Illuminate\Validation\ValidationException;


class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    public function changePassword(Request $request)
    {
        
        $user = Auth::user();
        if($request->otp == null)
        {
            $code = random_int(100000, 999999);
            $user->otp = $code;
            $user->save();
            $this->html_mail($user->email);
            exit;
        }
        if (Hash::check($request->current_password, $user->password)) 
        {
            // Alert::error('Error!', 'Your current password is wrong!');
            // return back();
            $request->validate([
                'current_password' => 'required',
                'password' => ['required', 'confirmed'
                , Rules\Password::min(10)->mixedCase()
                  ->numbers()
                  ->symbols()
                  ->uncompromised()]
                ]
              ,[
                  'current_password.required' => 'current_password is required'
              ]);
            if($request->otp ==$user->otp)
            {
                $user->password = Hash::make($request->password);
                $user->save();
                $Userpassword = UserInfo::create([
                    'user_id' => $user->id,
                    'type' => "Password",
                ]);
                Alert::success('Success!!', 'Password changed successfully!!');
                return redirect()->route('account.show');
            }
            else
            {
                return redirect()->back()->withErrors(['name' => 'The otp is wrong']);
            }
        }
        throw ValidationException::withMessages([
            'current_password' => 'Wrong password',
        ]);
        
    }

    public function html_mail($email=null)
    {
        $user = Auth::user();
        $code = $user->otp;
        $info = array(
            'name' => "Voolo"
        );
        $data = array('email'=>$email,'name'=>"info",'code'=>$code);
        Mail::send(['data' => $data], $info, function ($message) use ($data)
        {
            $message->to($data['email']) 
                ->subject('OTP Reset Password');
                $message->setBody('Your OTP is:'.$data['code']);
            $message->from('info@voolo.vn', 'Voolo');
        });
        echo "Successfully sent the email";
    }

    public function validation_pass(Request $request){
        $user = Auth::user();
        if (Hash::check($request->current_password, $user->password)) {
            $request->validate([
                'current_password' => 'required',
                'password' => ['required', 'confirmed'
                , Rules\Password::min(10)->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()]
                ]
            ,[
                'current_password.required' => 'current_password is required'
            ]);
            return true;
        }
        throw ValidationException::withMessages([
            'current_password' => 'Wrong password',
        ]);
    }
}
