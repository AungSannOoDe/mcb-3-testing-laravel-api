@extends('layouts.layout')
@section('title', 'Forgot Password')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('user.forgot-password') }}" class="shadow-lg p-5 rounded-3">
                @csrf
                <div class="form-group mb-3">
                    <label for="phone" class="d-block py-3">ဖုန်းနံပါတ်</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                        name="phone" value="{{ old('phone') }}" placeholder="09XXXXXXXXX" required autofocus>
                    
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="dateOfBirth" class="d-block py-3">မွေးသက္ကရာဇ်</label>
                    <input id="dateOfBirth" type="date" 
                        class="form-control @error('DOB') is-invalid @enderror" 
                        name="DOB" required>
                    
                    @error('DOB')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="submit w-100">ဆက်သွားပါ</button>
                <a href="{{ route('user.login') }}" class="back text-center my-2">နောက်သို့</a>
            </form>
        </div>
    </div>
</div>
 <!--login css-->
@endsection