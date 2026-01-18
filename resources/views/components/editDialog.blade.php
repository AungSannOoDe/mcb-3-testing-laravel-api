@props(['item','type'])
<div class="modal fade" id="editDialog{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('facts.update', $item->id) }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-body">
                <div class="question text-center text-info">
                    <p style="font-size:2em;">
                        <i class="fa-solid fa-circle-info"></i>
                    </p>
                    <p style="font-size:1.3em;">အချက်အလက်ပြင်ဆင်မည်လား ?</p>
                </div>
                <input type="hidden" name="type" value="{{$type}}">
                <input type="text" name="name" value="{{ $item->name }}" class="form-control">
            </div>
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ပိတ်ရန်</button>
                <button type="submit" class="btn btn-success">အပ်ဒိတ်လုပ်ရန်</button>
            </div>
        </form>
    </div>
</div>