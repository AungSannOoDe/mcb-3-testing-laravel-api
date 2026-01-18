@extends('layouts.app')

@section('title', 'Product Form')
@section('content')
<div class="container w-100 m-auto" style="max-width: 800px">
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
    <!--modal js-->
    @endif

    <form class="row justify-content-center g-3" action="{{ route('orders.edit',$order->id) }}" method="POST">
        @csrf

        <div class="col-md-6">
            <label for="exportDate" class="form-label">တင်ပို့သည့်ရက်စွဲ</label>
            <input type="date" name="export_date" value="{{ $order->export_date }}" class="form-control" id="exportDate" required>
        </div>
        <div class="col-md-6">
            <label for="sourceArea" class="form-label">ပွဲရုံ</label>
            <select name="source_area_id" id="sourceArea" class="form-select" required>
                <option value="{{$order->source_area_id}}">{{ $order->sourceArea->name }}</option>
                @foreach($areas as $area)
                @if($area->id != $order->source_area_id)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label for="category" class="form-label">ကုန်အမျိုးအစား</label>
            <input type="text" value="{{$order->category->name}}" class="form-control" readonly>
        </div>
        <div class="col-md-12">
            <label for="product" class="form-label">ကုန်အမည်</label>
            <select name="product_name" id="productName" class="form-select" required>
                <option value="{{$order->product_name}}">{{$order->product_name}}</option>
                @foreach($products as $product)
                @if($product->name != $order->product_name)
                <option value="{{$product->name}}">{{$product->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="weight" class="form-label">အတိုက်ချိန် (ပိဿာ.ကျပ်သား)</label>
            <input type="text" value="{{$order->weight}}" name="weight" placeholder="အလေးချိန်ကို ပိဿာ.ကျပ်သား ပုံစံဖြင့်ရေးပါ (ဉပမာ - 50.50)" class="form-control" id="weight" required>
        </div>
        <div class="col-md-6">
            <label for="netweight" class="form-label">အသားချိန် (ပိဿာ.ကျပ်သား)</label>
            <input type="text" value="{{$order->net_weight}}" name="netweight" placeholder="အလေးချိန်ကို ပိဿာ.ကျပ်သား ပုံစံဖြင့်ရေးပါ (ဉပမာ - 50.50)" class="form-control" id="netweight" required>
        </div>
        <div class="col-md-6">
            <label for="unit" class="form-label">ယူနစ်</label>
            <input type="text" value="{{$order->unit}}" class="form-control" readonly>
        </div>
        <div class="col-md-6">
            <label for="price" class="form-label">စျေးနှုန်း (၁ ပိဿာ)</label>
            <input type="text" name="price" value="{{$order->price}}" class="form-control" id="price" required>
        </div>
        <div class="col-md-6">
            <label for="total" class="form-label">စုစုပေါင်းကျသင့်ငွေ</label>
            <input type="text" name="total" value="{{$order->total}}" class="form-control" id="total" readonly>
        </div>
        <div class="col-md-6">
            <label for="gate" class="form-label">ဂိတ်</label>
            <select name="gate_id" id="gate" class="form-select" required>
                <option value="{{$order->gate_id}}">{{ $order->gate->name }}</option>
                @foreach($gates as $gate)
                @if($gate->id != $order->gate_id)
                <option value="{{ $gate->id }}">{{ $gate->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label for="weight_price" class="form-label">တန်ဆာခ</label>
            <input type="text" value="{{$order->weightfee}}" name="weight_price" class="form-control" id="weight_price">
        </div>
        <div class="col-12">
            <a href="{{ url('/user/'.auth()->user()->id.'/orders') }}" class="btn btn-danger">
                <i class="fa-solid fa-xmark"></i> ပယ်ဖျက်မည်
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fa-regular fa-floppy-disk"></i> သိမ်းမည်
            </button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        const baseUrl = "{{ url('') }}";
    
        // 1️⃣ Category → Product AJAX
        $('#category').on('change', function() {
            const categoryId = $(this).val();
            $('#product').html('<option value="">ကုန်အမည်ရွေးပါ</option>');
    
            if(categoryId) {
                $.ajax({
                    url: baseUrl + '/api/products/' + categoryId,
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

<!--product css and products js-->
@endsection