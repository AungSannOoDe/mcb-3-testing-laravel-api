<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function registerForm(){
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{7,11}$/', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required|same:password',
            'birth_date'=>'required'
        ],[

            'name.required' => 'အမည် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'phone.required' => 'ဖုန်းနံပါတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'phone.unique' => 'ဤဖုန်းနံပါတ်ဖြင့် အကောင့်ဖွင့်ထားပြီးသား ဖြစ်နေပါသည်။',
            'password.required' => 'စကားဝှက် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'password.min' => 'စကားဝှက်သည် အနည်းဆုံး ၈ လုံး ရှိရပါမည်။',
            'password_confirmation' => 'စကားဝှက် အတည်ပြုချက် မတူညီပါ။',
            'birth_date.required' => 'မွေးသက္ကရာဇ် ရွေးချယ်ပေးပါ။',
            'birth_date.before' => 'မွေးသက္ကရာဇ်သည် မှားယွင်းနေပါသည်။',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'birth_date' => $data['birth_date'],
            'role_id' => 1,
        ]);
    }
}
