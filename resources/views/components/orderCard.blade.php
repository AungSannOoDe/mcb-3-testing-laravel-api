@props(['order'])
<div class="order-card p-3">
    @if(auth()->user()->role_id == 1)
    <div class="order-header d-flex">
        <span class="flex-grow-1">{{ $order->export_date }}</span>
        @if($order->status == "ပို့နေဆဲ")
        <span class="order-status status-shipping">{{ $order->status }}</span>
        @elseif($order->status == "ရောက်ပြီး")
        <span class="order-status status-reached">{{ $order->status }}</span>
        @elseif($order->status == "ရောင်းပြီး")
        <span class="order-status status-sold">{{ $order->status }}</span>
        @endif
        <a href="{{ route('orders.edit',$order->id) }}" class="text-info fw-bold ms-3"><i class="fa-regular fa-pen-to-square"></i></a>
    </div>
    @endif
    @if(auth()->user()->role_id == 2)
    <div class="order-header">
        <span class="flex-grow-1">{{ $order->export_date }}</span>
        <!-- Example single danger button -->
        <div class="btn-group mx-2">
            @if($order->status == 'ပို့နေဆဲ')
            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $order->status }}
            </button>
            <ul class="dropdown-menu p-2">
                <li>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="1">
                        <button type="submit" class="dropdown-item bg-success text-white mb-1">ရောက်ပြီး</button>
                    </form>
                </li>
                <li>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="2">
                        <button type="submit" class="dropdown-item bg-primary text-white">ရောင်းပြီး</button>
                    </form>
                </li>
            </ul>
            @elseif($order->status == 'ရောက်ပြီး')
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $order->status }}
            </button>
            <ul class="dropdown-menu p-2">
                <li>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="2">
                        <button type="submit" class="dropdown-item bg-primary text-white">ရောင်းပြီး</button>
                    </form>
                </li>
            </ul>
            @else
            <button type="button" class="btn btn-primary">
                {{ $order->status }}
            </button>
            @endif
        </div>
        <span class="delete me-xs-2">
            <button type="submit" class="border-0 bg-transparent text-warning fw-bold" data-bs-toggle="modal" data-bs-target="#deleteDialog{{$order->id}}">
                <i class="fa-solid fa-trash"></i>
            </button>
        </span>
    </div>
    @endif
    <div class="p-3">
        @if(auth()->user()->role_id == 2)
        <p><b>တင်ပို့သူအမည် -</b> {{ $order->user->name }} ({{ $order->user->phone }})</p>
        @endif
        <p><b>ကုန်အမျိုးအစား -</b> {{ $order->category->name }}</p>
        <p><b>ကုန်အမည် -</b> {{ $order->product_name }}</p>
        <p><b>ပွဲရုံအမည် -</b> {{ $order->sourceArea->name }}</p>
        <button class="btn btn-sm btn-outline-success" data-bs-toggle="collapse" aria-expanded="false"
            aria-controls="orderDetails{{$order->id}}" data-bs-target="#orderDetails{{$order->id}}">
            အချက်လက်ကြည့်ရန် <i class="fa-solid fa-angle-down"></i>
        </button>
        <div id="orderDetails{{$order->id}}" class="collapse mt-2">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>အတိုက်ချိန်</th>
                        <th>အသားချိန်</th>
                        <th>Unit</th>
                        <th>ဈေးနှုန်း (၁ ပိဿာ)</th>
                        @if(auth()->user()->role_id == 1)
                        <th>Remark</th>
                        @endif
                    </tr>
                    <tr>
                        <td>{{ $order->weight }} ပိဿာ</td>
                        <td>{{ $order->net_weight }} ပိဿာ</td>
                        <td>{{ $order->unit }}</td>
                        <td>{{ $order->price }} MMK</td>
                        @if(auth()->user()->role_id == 1)
                        <td>{{ $order->remark ?? ' - ' }}</td>
                        @endif
                    </tr>
                    @if(auth()->user()->role_id == 2)
                    <tr>
                        <th>သင့်ငွေ</th>
                        <th>ဂိတ်</th>
                        <th>Refer To</th>
                        <th>တန်ဆာခ</th>
                    </tr>
                    <tr>
                        <td>{{ $order->total }} MMK</td>
                        <td>{{ $order->gate->name }}</td>
                        <td>{{ $order->shop->name ?? ' - ' }}</td>
                        <td>{{ $order->weightfee ?? 0 }} MMK</td>
                    </tr>
                    @endif
                    @if(auth()->user()->role_id == 2)
                    <tr>
                        <td colspan="4" class="border-0">
                            <form action="{{ route('orders.update', $order->id) }}" method="POST" class="text-center">
                                @csrf
                                <input type="text" name="remark" class="form-control my-3" value="{{ $order->remark ?? '' }}" placeholder="မှတ်ချက်ရှိပါကထည့်သွင်းပါ။">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-check"></i> သိမ်းရန်
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
<x-deleteDialog :item="$order" :type="'order'" />