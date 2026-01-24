@extends("layouts.app")

@section("title", "Orders")
@section("content")
 {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
        <p class="text-slate-500 text-sm font-medium">Today's Shipments</p>
        <h3 class="text-3xl font-bold mt-1">24</h3>
        <span class="text-emerald-500 text-xs font-bold">+12% from yesterday</span>
    </div>
    <div class="bg-indigo-600 p-6 rounded-3xl shadow-xl text-white">
        <p class="text-indigo-100 text-sm font-medium">Pending Delivery</p>
        <h3 class="text-3xl font-bold mt-1">108</h3>
        <span class="text-indigo-200 text-xs font-bold">Priority: High</span>
    </div>
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
        <p class="text-slate-500 text-sm font-medium">Completed (Month)</p>
        <h3 class="text-3xl font-bold mt-1">1,420</h3>
        <span class="text-slate-400 text-xs font-bold">Lashio Warehouse</span>
    </div>
</div> --}}
 @if(isset($orders))
<form action="{{ route('orders.export') }}" method="post">
    @csrf
    <input type="hidden" name="orders" value="{{ base64_encode(json_encode($orders)) }}">
    <button class="bg-emerald-600 hover:bg-emerald-700 ml-3 text-white px-8 py-3 rounded-xl font-bold transition" type="submit">Export All</button>
</form>
@endif
<div class="glass-card p-4 rounded-2xl border border-white shadow-sm flex flex-wrap items-center gap-4 mb-8">
    <div class="relative flex-grow min-w-[200px]">
        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </span>
        <input type="text" placeholder="Search by name, ID or cargo..." class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500 transition">
    </div>
    <input type="date" class="px-4 py-3 border border-slate-200 rounded-xl outline-none text-slate-600">
    <select class="px-4 py-3 border border-slate-200 rounded-xl outline-none text-slate-600 bg-white">
        <option>Filter by Status</option>
        <option value="shipping">Shipping</option>
        <option value="delivered">Delivered</option>
    </select>
    <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-bold transition">
        Apply
    </button>
</div>

<div class="space-y-4">
    <h2 class="text-xl font-bold text-slate-800 px-2 flex justify-between items-center">
        တင်ပို့ကုန်စာရင်း
        <span class="text-sm font-normal text-slate-400 italic">
            Showing {{ $orders->count() }} records
        </span>
    </h2>
    @forelse($orders as $order)
        <x-orderCard :order="$order" />
    @empty
        <div class="text-center py-12">
            <p class="text-slate-500 mt-4">လက်တလောတင်ပို့ကုန်များမရှိသေးပါ</p>
        </div>
    @endforelse
</div>

<div class="mt-6 flex justify-center">
    {{ $orders->links() }}
</div>

 <!-- #region -->
<!--order css-->
@endsection
