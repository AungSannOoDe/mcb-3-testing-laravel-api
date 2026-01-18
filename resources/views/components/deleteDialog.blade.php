@props(['item','type'])
<div class="modal fade" id="deleteDialog{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('facts.delete', $item->id) }}" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <div class="question text-center text-warning">
                    <p style="font-size:2em;">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </p>
                    <p style="font-size:1.3em;"><span class="text-danger">{{ $item->name??'ဤအချက်လက်' }}</span> ကို အပြီးတိုင် ဖျက်ပစ်တော့မည်။ ဆက်လုပ်မည်လား?</p>
                </div>
                <input type="hidden" name="type" value="{{$type}}">
                <div class="btns text-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">မဖျက်ပါ</button>
                    <button type="submit" class="btn btn-danger">ဖျက်မည်</button>
                </div>
            </div>
        </form>
    </div>
</div>