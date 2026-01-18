@extends('layouts.app')
@section('title', 'Product Categories')
@section('content')
<div class="container">
    @if($categories->isEmpty())
    <div class="empty text-center">
        <img src="{{ asset('images/empty.gif') }}" alt="empty" style="max-width:250px;">
    </div>
    <p class="text-center fs-5">တင်ပို့နေသောကုန်ပစ္စည်းအမျိုးအစားများမရှိသေးပါ</p>
    @else
    <h2 class="text-center py-3">တင်ပို့နေသောကုန်ပစ္စည်းအမျိုးအစားများ</h2>
    @foreach($categories as $category)
    <x-item :item="$category" :type="'category'" />
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection