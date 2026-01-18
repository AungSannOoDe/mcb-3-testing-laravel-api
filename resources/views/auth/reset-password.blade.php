@extends('layouts.layout')
@section('title', 'Forgot Password')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('user.reset-password.submit') }}" class="shadow-lg p-5 rounded-3">
                @csrf
                <div class="mb-3">
                    <label class="form-label">စကားဝှက်အသစ်</label>
                    <input type="password" name="new_password"
                        class="form-control  @error('new_password') is-invalid @enderror" required>
                    @error('new_password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">စကားဝှက်အသစ်အတည်ပြုပါ</label>
                    <input type="password" name="new_password_confirmation"
                        class="form-control" required>
                </div>
                <input type="hidden" name="phone" value="{{ session('phone') }}">
                <button type="submit" class="submit w-100">ဆက်သွားပါ</button>
                <a href="{{ route('user.forgot-password.show') }}" class="back text-center my-2">နောက်သို့</a>
            </form>
        </div>
    </div>
</div>
<!--login css-->
@endsection