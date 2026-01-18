@extends("layouts.app")

@section("title", "Orders")
@section("content")
<div class="container mb-5">
    @if(isset($orders))
    <form action="{{ route('orders.export') }}" method="post">
        @csrf
        <input type="hidden" name="orders" value="{{ base64_encode(json_encode($orders)) }}">
        <button class="btn btn-success" type="submit">Export All</button>
    </form>
    @endif
    @if(auth()->user()->id == 2)
    <div class="row filterBox">
        <div class="col-12 col-md-4">
            <x-status-dropdown></x-status-dropdown>
        </div>
        <form action="{{ url('/orders/') }}" method="get" class="col-12 col-md-8">
            @if(request('status'))
            <input type="hidden" name="status" value="{{request('status')}}">
            @endif
            <div class="row">
            <div class="col-12 col-md-5 mt-md-3 mb-3">
                <label for="fromDate" class="form-label">From Date</label>
                <input type="date" id="fromDate" name="from_date"
                value="{{ request('from_date') }}"
                class="form-control text-success">
            </div>
            <div class="col-12 col-md-5 mt-md-3 mb-3">
                <label for="toDate" class="form-label">To Date</label>
                <input type="date" id="toDate" name="to_date"
                value="{{ request('to_date') }}"
                class="form-control text-success">
            </div>
            <div class="col-12 col-md-2 mb-3">
                <button type="submit" class="btn btn-outline-info mt-md-5 w-100">
                    Search
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            </div>
        </form>
    </div>
    @endif
    @if(auth()->user()->id == 1)
    <div class="row filterBox">
        <div class="col-12 col-md-4">
            <x-status-dropdown></x-status-dropdown>
        </div>
        <form action="{{ url('/user/'.auth()->id().'/orders') }}" method="get" class="col-12 col-md-8">
            @if(request('status'))
            <input type="hidden" name="status" value="{{request('status')}}">
            @endif
            <div class="row">
            <div class="col-12 col-md-5 mt-md-3 mb-3">
                <label for="fromDate" class="form-label">From Date</label>
                <input type="date" id="fromDate" name="from_date"
                value="{{ request('from_date') }}"
                class="form-control text-success">
            </div>
            <div class="col-12 col-md-5 mt-md-3 mb-3">
                <label for="toDate" class="form-label">To Date</label>
                <input type="date" id="toDate" name="to_date"
                value="{{ request('to_date') }}"
                class="form-control text-success">
            </div>
            <div class="col-12 col-md-2 mb-3">
                <button type="submit" class="btn btn-outline-info mt-md-5 w-100">
                    Search
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            </div>
        </form>
    </div>
    @endif

    @if($orders->isEmpty())
    <div class="empty text-center">
        <img src="{{ asset('images/empty.gif') }}" alt="empty" style="max-width:250px;">
    </div>
    <p class="text-center fs-5">လက်တလောတင်ပို့ကုန်များမရှိသေးပါ</p>
    @else
    <h3 class="my-3 text-center">တင်ပို့ကုန်စာရင်း</h3>
    <!-- Order Cards -->
    @foreach($orders as $order)
    <x-orderCard :order="$order" />
    @endforeach
    @endif
</div>
<div class="d-flex justify-content-center">
    {{ $orders->links() }}
</div>
</div>
<!--order css-->
@endsection