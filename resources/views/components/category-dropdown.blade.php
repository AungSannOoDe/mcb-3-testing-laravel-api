<div class="flex justify-center my-6" x-data="{ open: false }">
    <div class="relative inline-block text-left w-full max-w-xs">
        {{-- Trigger Button --}}
        <button @click="open = !open" @click.away="open = false" type="button"
            class="flex items-center justify-between w-full px-5 py-3 bg-white border border-slate-200 rounded-2xl shadow-sm text-slate-700 font-bold hover:border-indigo-400 hover:text-indigo-600 transition-all duration-200 focus:ring-2 focus:ring-indigo-100 outline-none">

            <div class="flex items-center gap-3">
                <i class="fa-solid fa-filter text-slate-400 text-sm"></i>
                <span>{{ isset($currentCategory) ? $currentCategory->name : 'အမျိုးအစားရွေးချယ်ရန်' }}</span>
            </div>

            <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        {{-- Dropdown Menu --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="absolute z-[70] mt-2 w-full bg-white border border-slate-100 rounded-2xl shadow-2xl py-2 overflow-hidden"
             style="display: none;">

            {{-- All Products Option --}}
            <a href="{{ url('/products') }}"
               class="block px-5 py-2.5 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition {{ !isset($currentCategory) ? 'bg-indigo-50 text-indigo-600 font-bold' : '' }}">
                အားလုံးကြည့်ရန်
            </a>

            <div class="h-px bg-slate-50 my-1"></div>

            {{-- Category List --}}
            <div class="max-h-60 overflow-y-auto custom-scrollbar">
                @foreach($categories as $category)
                <a href="{{ url('/products?category='.$category->name) }}"
                   class="block px-5 py-2.5 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition {{ isset($currentCategory) && $currentCategory->id == $category->id ? 'bg-indigo-50 text-indigo-600 font-bold' : '' }}">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
