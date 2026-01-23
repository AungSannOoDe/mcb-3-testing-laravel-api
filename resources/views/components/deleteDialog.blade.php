@props(['item','type'])

<div x-data="{ open: false }">
    {{-- Trigger button (optional) --}}
    <button @click="open = true" class="p-2 text-red-500 hover:text-white hover:bg-red-500 rounded transition">
        <i class="fa-solid fa-trash"></i>
    </button>

    {{-- Modal Overlay --}}
    <div
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        {{-- Modal Container --}}
        <div
            x-show="open"
            x-transition
            @click.away="open = false"
            class="bg-white rounded-xl shadow-xl max-w-md w-full p-6"
        >
            <form action="{{ route('facts.delete', $item->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('DELETE')
                <input type="hidden" name="type" value="{{ $type }}">

                {{-- Warning Icon --}}
                <div class="text-center text-warning">
                    <p class="text-4xl text-yellow-500">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </p>
                    <p class="text-lg mt-2">
                        <span class="text-red-600 font-semibold">{{ $item->name ?? 'ဤအချက်လက်' }}</span> ကို အပြီးတိုင် ဖျက်ပစ်တော့မည်။ ဆက်လုပ်မည်လား?
                    </p>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-center gap-4 mt-4">
                    <button type="button" @click="open = false" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">
                        မဖျက်ပါ
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                        ဖျက်မည်
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
