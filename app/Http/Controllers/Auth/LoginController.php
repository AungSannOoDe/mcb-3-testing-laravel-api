<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function credentials(Request $request)
    {
        return [
            'phone' => $request->phone,
            'password' => $request->password,
        ];
    }


    public function username()
    {
        return 'phone';
    }

    public function userLoginForm()
    {
        return view('auth.login');
    }

    public function adminLoginForm()
    {
        return view('auth.adminlogin');
    }

    public function login(Request $request)
    {
        // Validate form fields first
        $request->validate([
            'phone' => 'required|digits_between:9,15',
            'password' => 'required|min:6',
        ], [
            'phone.required' => 'ဖုန်းနံပါတ်ထည့်ပါ။',
            'password.required' => 'စကားဝှက်ထည့်ပါ။',
            'password.min' => 'စကားဝှက်မှာ အနည်းဆုံး ၆ လုံးရှိရမည်။',
        ]);

        // Find user by phone
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            // Phone not found
            return back()->withErrors(['phone' => 'ဤဖုန်းနံပါတ်ဖြင့် အသုံးပြုသူ မတွေ့ပါ။'])->withInput();
        }

        // Check password manually
        if (!Hash::check($request->password, $user->password)) {
            // Password wrong → show error only on password field
            return back()->withErrors(['password' => 'စကားဝှက် မမှန်ပါ။'])->withInput();
        }

        // If both correct, login user
        Auth::login($user, $request->remember);

        return redirect()->intended('/home');
    }
}
