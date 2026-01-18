@extends('layouts.layout')

@section('title')
    Role Selection Form
@endsection
@section('content')
    <div class="container w-100 m-auto my-5 shadow-lg rounded-2" style="max-width:700px;">
        <form action="{{ route('role.submit') }}" method="post" class="p-3 text-center">
            @csrf

            <h2 class="text-center py-3">အသုံးပြုသူအဆင့်‌‌သတ်မှတ်ပါ</h2>
            <div class="row g-3">
                <div class="col-12 col-sm-6">
                    <div class="user exporter text-center p-4 rounded-1">
                        <i class="fa-solid fa-user" style="font-size:2em"></i>
                        <p class="py-3" style="font-size:1.5em;">အသုံးပြုသူ</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="user admin text-center p-4 rounded-1">
                        <i class="fa-solid fa-user-tie" style="font-size:2em"></i>
                        <p class="py-3" style="font-size:1.5em;">အက်ဒ်မင်</p>
                    </div>
                </div>
            </div>
            <input type="hidden" name="role" class="role" value="1" required>
            <button type="submit" class="submit my-3">ဆက်လုပ်ပါ <i class="fa-solid fa-arrow-right"></i></button>
        </form>
    </div>
@endsection