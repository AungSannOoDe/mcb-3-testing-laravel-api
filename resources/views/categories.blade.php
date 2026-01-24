@extends('layouts.app')
@section('title', 'Product Categories')
@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    @if($categories->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 bg-white rounded-3xl border border-dashed border-slate-200">
            <img src="{{ asset('images/empty.gif') }}" alt="empty" class="w-48 mb-4 mix-blend-multiply">
            <p class="text-slate-400 font-medium">တင်ပို့နေသောကုန်ပစ္စည်းအမျိုးအစားများမရှိသေးပါ</p>
        </div>
    @else
        {{-- Header Section --}}
        <div class="flex items-end justify-between mb-6">
            <div>
                <h2 class="text-2xl font-black text-slate-800">
                    တင်ပို့နေသော <span class="text-indigo-600">အမျိုးအစားများ</span>
                </h2>
            </div>
            <p class="text-slate-400 text-sm italic">
                Showing {{ $categories->count() }} records
            </p>
        </div>

        {{-- The List --}}
        <div class="space-y-1">
            @foreach($categories as $category)
                <x-item :item="$category" :type="'category'" />
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $categories->links() }}
        </div>
    @endif
</div>
@endsection
