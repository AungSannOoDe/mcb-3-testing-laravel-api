@extends('layouts.app')

@section('title', 'Product Form')
@section('content')
<div class="container w-100 m-auto" style="max-width: 800px">
    <h2 class="text-center py-3">တင်ပို့ကုန်အချက်လက်များကိုမှန်ကန်စွာထည့်သွင်းပါ</h2>

    {{-- Show Modal for Success or Error --}}
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.querySelector('.modalBtn');
            if (btn) btn.click();
        });
    </script>
    @endif

    <form class="row justify-content-center g-3" action="{{ url('order/add') }}" method="POST">
        @csrf

        <div class="col-md-6">
            <label for="exportDate" class="form-label">တင်ပို့သည့်ရက်စွဲ</label>
            <input type="date" name="export_date" class="form-control" id="exportDate" required>
        </div>

        <div class="col-md-6">
            <label for="sourceArea" class="form-label">ပွဲရုံ</label>
            <select name="source_area_id" id="sourceArea" class="form-select" required>
                <option value="">ပွဲရုံအမည်ရွေးပါ</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12">
            <label for="category" class="form-label">ကုန်အမျိုးအစား</label>
            <select name="category_id" id="category" class="form-select" required>
                <option value="">ကုန်အမျိုးအစားရွေးပါ</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12">
            <label for="product" class="form-label">ကုန်အမည်</label>
            <select name="product" id="product" class="form-select" required>
                <option value="">ကုန်အမည်ရွေးပါ</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="weight" class="form-label">အတိုက်ချိန် (ပိဿာ.ကျပ်သား)</label>
            <input type="text" name="weight" id="weight" class="form-control" placeholder="ဥပမာ 50.50" required>
        </div>

        <div class="col-md-6">
            <label for="netweight" class="form-label">အသားချိန် (ပိဿာ.ကျပ်သား)</label>
            <input type="text" name="netweight" id="netweight" class="form-control" placeholder="ဥပမာ 50.50" required>
        </div>

        <div class="col-md-6">
            <label for="unit" class="form-label">ယူနစ်</label>
            <select name="unit" id="unit" class="form-select" required>
                <option value="">ယူနစ်ရွေးပါ</option>
                <option value="ခြင်း">ခြင်း</option>
                <option value="အိတ်">အိတ်</option>
                <option value="‌ေဖာ့ဘူး">‌ေဖာ့ဘူး</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="price" class="form-label">စျေးနှုန်း (၁ ပိဿာ)</label>
            <input type="text" name="price" id="price" class="form-control" value="0" required>
        </div>

        <div class="col-md-6">
            <label for="total" class="form-label">စုစုပေါင်းကျသင့်ငွေ</label>
            <input type="text" name="total" id="total" class="form-control" value="0" readonly>
        </div>

        <div class="col-md-6">
            <label for="status" class="form-label">ကုန်ပစ္စည်းအခြေနေ</label>
            <select name="status" id="status" class="form-select" required>
                <option value="ပို့နေဆဲ">ပို့နေဆဲ</option>
                <option value="ရောက်ပြီး">ရောက်ပြီး</option>
                <option value="ရောင်းပြီး">ရောင်းပြီး</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="referto" class="form-label">Refer To</label>
            <select name="shop_id" id="referto" class="form-select">
                <option value="">ထပ်မံပို့စေချင်သောဆိုင်အမည်ရှိပါကရွေးပါ</option>
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="gate" class="form-label">ဂိတ်</label>
            <select name="gate_id" id="gate" class="form-select" required>
                @foreach($gates as $gate)
                    <option value="{{ $gate->id }}">{{ $gate->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12">
            <label for="weight_price" class="form-label">တန်ဆာခ</label>
            <input type="text" name="weight_price" id="weight_price" class="form-control">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">တင်မည်</button>
        </div>
    </form>
</div>

{{-- jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- JS for category → product & price calculation --}}
<script>
$(document).ready(function() {
    const baseUrl = "{{ url('') }}";

    // 1️⃣ Category → Product AJAX
    $('#category').on('change', function() {
        const categoryId = $(this).val();
        $('#product').html('<option value="">ကုန်အမည်ရွေးပါ</option>');

        if(categoryId) {
            $.ajax({
                url: baseUrl + '/products/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $.each(res, function(_, product) {
                        $('#product').append('<option value="' + product.name + '">' + product.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
    });

    // 2️⃣ Price Calculation
    function calculateTotal() {
        const price = parseFloat($('#price').val().replace(/[^\d.]/g, '')) || 0;
        const netWeight = parseFloat($('#netweight').val().replace(/[^\d.]/g, '')) || 0;
        $('#total').val((price * netWeight).toFixed(2));
    }

    $('#price, #netweight').on('input', calculateTotal);
});
</script>

<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
