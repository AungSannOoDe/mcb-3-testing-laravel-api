<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'လက်ရှိစကားဝှက်ကို ဖြည့်ပါ။',
            'new_password.required' => 'စကားဝှက်အသစ်ကို ဖြည့်ပါ။',
            'new_password.min' => 'စကားဝှက်အသစ်သည် အနည်းဆုံး စာလုံး ၆ လုံးရှိရပါမည်။',
            'new_password.confirmed' => 'အတည်ပြုစကားဝှက် မကိုက်ညီပါ။',
        ]);


        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            $validator->errors()->add('current_password', 'လက်ရှိစကားဝှက် မမှန်ပါ။');
            return back()->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'စကားဝှက်ပြောင်းခြင်းအောင်မြင်ပါသည်။');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'phone' => 'required|digits_between:9,15',
                'DOB' => 'required'
            ],
            [
                'phone.required' => 'ဖုန်းနံပါတ်ထည့်ပါ။',
                'DOB.required' => 'မွေးသက္ကရာဇ်ထည့်ပါ။'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::firstWhere('phone', $request->phone);
        if (!$user) {
            // Phone not found
            return back()->withErrors(['phone' => 'ဖုန်းနံပါတ်မှားနေသည်။'])->withInput();
        }
        if ($user->birth_date !== $request->DOB) {
            return back()->withErrors(['DOB' => 'မွေးသက္ကရာဇ်မှားနေသည်။'])->withInput();
        }

        return redirect('/reset-password')->with('phone', $request->phone);
    }

    public function showResetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'new_password' => 'required|min:6|confirmed',
            ],
            [
                'new_password.required' => 'စကားဝှက်အသစ်ကို ဖြည့်ပါ။',
                'new_password.min' => 'စကားဝှက်အသစ်သည် အနည်းဆုံး စာလုံး ၆ လုံးရှိရပါမည်။',
                'new_password.confirmed' => 'အတည်ပြုစကားဝှက် မကိုက်ညီပါ။',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::firstWhere('phone', $request->phone);
        if (!$user) {
            return back()->with('error', 'ဖုန်းနံပါတ်မတွေ့ပါ။');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        if($user->role && $user->role->id == 1){
            return redirect()->route('user.login')->with('success', 'စကားဝှက်အသစ်အားအတည်ပြုပြီးဖြစ်ပါသည်။');
        }else{
            return redirect()->route('admin.login')->with('success', 'စကားဝှက်အသစ်အားအတည်ပြုပြီးဖြစ်ပါသည်။');
        }
    }
}
