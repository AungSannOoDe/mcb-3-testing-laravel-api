@extends('layouts.app')
@section('title', 'Product Categories')
@section('content')
<div class="container">
    @if(session('error'))
    <x-modal>
        <p class="text-center" style="font-size:2.5em;">
            <i class="fa-solid fa-circle-xmark text-danger"></i>
        </p>
        <p class="text-danger text-center" style="font-size:1.1em;">
            {{ session('error') }}
        </p>
    </x-modal>
    <!--modal load js-->
    @endif
    @if($gates->isEmpty())
    <div class="empty text-center">
        <img src="{{ asset('images/empty.gif') }}" alt="empty" style="max-width:250px;">
    </div>
    <p class="text-center fs-5">လက်တလောတင်ပို့နေသောဂိတ်များမရှိသေးပါ</p>
    @else
    <h2 class="text-center py-3">လက်တလောတင်ပို့နေသောဂိတ်များ</h2>
    @foreach($gates as $gate)
    <x-item :item="$gate" :delete="'delete'" :type="'gate'" />
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $gates->links() }}
    </div>
    @endif
</div>
@endsection