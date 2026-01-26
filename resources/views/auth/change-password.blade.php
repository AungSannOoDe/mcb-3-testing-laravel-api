@extends('layouts.app')

@section('title', 'change password')
@section('content')
<div class="container mt-5">
    @if(session('success'))
    <x-modal>
        <p class="text-center" style="font-size:2.5em;">
            <i class="fa-solid fa-circle-check text-success"></i>
        </p>
        <p class="text-success text-center" style="font-size:1.1em;">
            {{ session('success') }}
        </p>
    </x-modal>
    <!--modal load js-->
    @endif
    <div class="w-full max-w-sm space-y-10 p-6 z-10">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center fs-5">
                    စကားဝှက်ပြောင်းရန်
                </div>
                <div class="card-body">

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">လက်ရှိစကားဝှက်</label>
                            <input type="password" name="current_password"
                                class="form-control  @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

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
                        <button type="submit" class="btn btn-primary w-100">စကားဝှက်ပြောင်းရန်</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection