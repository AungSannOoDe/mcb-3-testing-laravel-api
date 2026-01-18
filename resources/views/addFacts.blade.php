@extends('layouts.app')
@section('title', 'Fact Adding Form')
@section('content')

<!-- Background video -->
<video class="bg-video" autoplay muted loop playsinline>
    <source src="{{ asset('images/shipping.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
</video>

<!-- Overlay -->
<div class="overlay"></div>

<div class="container form-container py-4">
    @if(session('success') || session('error'))
    <x-modal>
        <p class="text-center" style="font-size:2.5em;">
            @if(session('success'))
            <i class="fa-solid fa-circle-check text-success"></i>
            @else
            <i class="fa-solid fa-triangle-exclamation text-warning"></i>
            @endif
        </p>
        <p class="{{ session('success') ? 'text-success' : 'text-warning' }} text-center" style="font-size:1.2em;">
            {{ session('success') ?? session('error') }}
        </p>
    </x-modal>
    <!--modal load js-->
    @endif
    <form action="{{ url('/category/add') }}" class="m-2" method="POST">
        @csrf
        <p class="d-inline-flex gap-1">
            <button class="btn btn-primary toggle" type="button" data-bs-toggle="collapse" data-bs-target="#categoryCollapse" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-solid fa-plus"></i> ကုန်အမျိုးအစားထည့်ရန် <i class="fa-solid fa-list"></i>
            </button>
        </p>
        <div class="collapse" id="categoryCollapse">
            <div class="card card-body">
                <input type="text" name="category" class="form-control mb-3" placeholder="ကုန်အမျိုးအစားအသစ်ထည့်ပါ။">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> သိမ်းရန်</button>
            </div>
        </div>
    </form>
    <form action="{{ url('/product/add') }}" class="m-2" method="POST">
        @csrf
        <p class="d-inline-flex gap-1">
            <button class="btn btn-danger toggle" type="button" data-bs-toggle="collapse" data-bs-target="#productCollapse" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-solid fa-plus"></i> ကုန်ပစ္စည်းအသစ်ထည့်ရန် <i class="fa-brands fa-product-hunt"></i>
            </button>
        </p>
        <div class="collapse" id="productCollapse">
            <div class="card card-body">
                <select name="category_id" class="form-select mb-3">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="product" class="form-control mb-3" placeholder="ကုန်ပစ္စည်းအသစ်ထည့်ပါ။">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> သိမ်းရန်</button>
            </div>
        </div>
    </form>
    <form action="{{ url('/sourceArea/add') }}" class="m-2" method="POST">
        @csrf
        <p class="d-inline-flex gap-1 mb-3">
            <button class="btn btn-secondary toggle" type="button" data-bs-toggle="collapse" data-bs-target="#areaCollapse" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-solid fa-plus"></i> ပွဲရုံအမည်အသစ်ထည့်ရန် <i class="fa-solid fa-building-columns"></i></i>
            </button>
        </p>
        <div class="collapse" id="areaCollapse">
            <div class="card card-body">
                <input type="text" name="sourceArea" class="form-control mb-3" placeholder="ပွဲရုံအမည်အသစ်ထည့်ပါ။">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> သိမ်းရန်</button>
            </div>
        </div>
    </form>
    <form action="{{ url('/gate/add') }}" class="m-2" method="POST">
        @csrf
        <p class="d-inline-flex gap-1 mb-3">
            <button class="btn btn-success toggle" type="button" data-bs-toggle="collapse" data-bs-target="#gateCollapse" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-solid fa-plus"></i> ဂိတ်အမည်အသစ်ထည့်ရန် <i class="fa-solid fa-bus-simple"></i>
            </button>
        </p>
        <div class="collapse" id="gateCollapse">
            <div class="card card-body">
                <input type="text" name="gate" class="form-control mb-3" placeholder="ဂိတ်အမည်အသစ်ထည့်ပါ။">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> သိမ်းရန်</button>
            </div>
        </div>
    </form>
    <form action="{{ url('/shop/add') }}" class="m-2" method="POST">
        @csrf
        <p class="d-inline-flex gap-1 mb-3">
            <button class="btn btn-dark toggle" type="button" data-bs-toggle="collapse" data-bs-target="#shopCollapse" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-solid fa-plus"></i> လွှဲပြောင်းအမည်ထည့်ရန် <i class="fa-solid fa-shop"></i>
            </button>
        </p>
        <div class="collapse" id="shopCollapse">
            <div class="card card-body">
                <input type="text" name="shop" class="form-control mb-3" placeholder="လွှဲပြောင်းအမည်အသစ်ထည့်ပါ။">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> သိမ်းရန်</button>
            </div>
        </div>
    </form>
</div>
<!--facts css-->
@endsection