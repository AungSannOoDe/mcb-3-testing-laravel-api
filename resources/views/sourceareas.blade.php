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
    <!--modal js -->
    @endif
    @if($areas->isEmpty())
    <div class="empty text-center">
        <img src="{{ asset('images/empty.gif') }}" alt="empty" style="max-width:250px;">
    </div>
    <p class="text-center fs-5">ပွဲရုံများမရှိသေးပါ</p>
    @else
    <h2 class="text-center py-3">ပွဲရုံများ</h2>
    @foreach($areas as $area)
    <x-item :item="$area" :delete="'delete'" :type="'sourcearea'" />
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $areas->links() }}
    </div>
    @endif
</div>
@endsection