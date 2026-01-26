@extends('layouts.app')

@section('title', 'change password')
@section('content')
<section class="relative flex flex-col  items-center  min-h-screen bg-white">

    @if (session('success'))
        <div class="fixed top-10 flex items-center bg-green-50 border border-green-200 text-green-700 px-6 py-3 rounded-2xl shadow-sm z-50">
            <i class="fa-solid fa-circle-check mr-2"></i>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="w-full max-w-sm space-y-10 p-6 z-10">
        <div class="space-y-3 text-center">
            <h1 class="text-3xl font-bold text-stone-900 tracking-tight">Update Password</h1>
            <p class="text-stone-500 text-base leading-relaxed">
                စကားဝှက်အသစ် ပြောင်းလဲသတ်မှတ်ရန်
            </p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            <div>
                <label for="current_password" class="block text-sm font-medium text-stone-700">လက်ရှိစကားဝှက်</label>
                <input type="password" name="current_password" id="current_password" required
                    class="input-box mt-1.5 w-full @error('current_password') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="••••••••">

                @error('current_password')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="new_password" class="block text-sm font-medium text-stone-700">စကားဝှက်အသစ်</label>
                <input type="password" name="new_password" id="new_password" required
                    class="input-box mt-1.5 w-full @error('new_password') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Enter new password">

                @error('new_password')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="new_password_confirmation" class="block text-sm font-medium text-stone-700">စကားဝှက်အသစ်အတည်ပြုပါ</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                    class="input-box mt-1.5 w-full"
                    placeholder="Confirm new password">
            </div>

            <div class="pt-4">
                <button type="submit" class="btn-primary w-full py-3 bg-indigo-400 text-white font-semibold rounded-xl hover:bg-indigo-500 transition-all shadow-md active:scale-95">
                    စကားဝှက်ပြောင်းရန်
                </button>
                
                <a href="{{ url()->previous() }}" class="block text-center mt-6 text-sm text-stone-400 hover:text-stone-800 transition">
                    ← မူလစာမျက်နှာသို့
                </a>
            </div>
        </form>
    </div>
</section>
@endsection