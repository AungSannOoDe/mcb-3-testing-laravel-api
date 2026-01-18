@extends('layouts.layout')

@section('title')
User Login Form
@endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endsession
            <form method="POST" action="{{ route('login') }}" class="shadow-lg p-5 rounded-3">
                @csrf
                <h2 class="text-center">အသုံးပြုသူ အကောင့်ဝင်ရန်</h2>
                <div class="form-group mb-3">
                    <label for="phone" class="d-block py-3">ဖုန်းနံပါတ်</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" value="{{ old('phone') }}" placeholder="09XXXXXXXXX" required autofocus>

                    @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="d-block py-3">စကားဝှက်</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" required>

                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">အကောင့်လက်ခံထားမယ်</label>
                </div>

                <button type="submit" class="submit w-100">အကောင့်ဝင်ရန်</button>
                <a href="{{ url('/role') }}" class="back text-center my-2">နောက်သို့</a>
                <p class="text-center">
                    <a href="{{ route('user.forgot-password') }}">စကားဝှက်မေ့နေသလား?</a>
                </p>
                <p class="text-center">
                    အကောင့်မရှိဘူးလား?
                    <a href="{{ route('user.register') }}">မှတ်ပုံတင်ပါ</a>
                </p>
            </form>
        </div>
    </div>
</div>
<!--login css-->
@endsection