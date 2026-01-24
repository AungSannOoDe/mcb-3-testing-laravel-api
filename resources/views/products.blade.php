@extends('layouts.app')
@section('title', 'Product Categories')
@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    {{-- Error Handling with Tailwind Modal --}}
    @if(session('error'))
    <div x-data="{ show: true }" x-show="show"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

        {{-- Modal Content --}}
        <div class="relative bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full text-center border border-slate-100">
            <div class="mb-4 text-red-500 text-6xl">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <p class="text-slate-800 font-bold text-lg mb-6">{{ session('error') }}</p>
            <button @click="show = false"
                    class="w-full py-3 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition">
                ပိတ်ရန်
            </button>
        </div>
    </div>
    @endif

    @if($products->isEmpty())
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-20">
            <div class="relative mb-6">
                <div class="absolute inset-0 bg-indigo-100 rounded-full blur-3xl opacity-30"></div>
                <img src="{{ asset('images/empty.gif') }}" alt="empty" class="relative w-64 mix-blend-multiply">
            </div>
            <p class="text-slate-400 font-medium text-lg italic">ကုန်အမည်များမရှိသေးပါ</p>
        </div>
    @else
        {{-- Header Section --}}
        <div class="mb-10 text-center">
            <h2 class="text-3xl font-black text-slate-800 mb-2">ကုန်အမည်များ</h2>
            <div class="w-20 h-1.5 bg-indigo-600 mx-auto rounded-full"></div>
        </div>

        {{-- Filters Section --}}
        <div class="mb-8 flex justify-center">
            <div class="w-full max-w-md">
                <x-category-dropdown></x-category-dropdown>
            </div>
        </div>

        {{-- Product List --}}
        <div class="space-y-4">
            @foreach($products as $product)
                {{-- This component should now use the Tailwind structure we built --}}
                <x-item :item="$product" :delete="'delete'" :type="'product'" />
            @endforeach
        </div>

        {{-- Modern Pagination --}}
        <div class="mt-10 flex justify-center">
            <div class=" p-2   rounded-2xl  gap-4  shadow-sm">
                {{ $products->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
