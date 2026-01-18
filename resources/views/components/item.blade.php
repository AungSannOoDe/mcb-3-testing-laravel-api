@props(['item','delete' => null,'type'])
<div class="card mb-1 p-2 w-100 m-auto" style="max-width:500px;">
    <div class="card-body d-flex">
        <div class="item flex-grow-1">
            <p class="card-text text-success fw-bold">
                {{ $item->name }}
            </p>
        </div>
        <div class="actions d-flex">
            <span class="edit pe-2">
                <button type="button" class="border-0 bg-transparent text-info fw-bold" data-bs-toggle="modal" data-bs-target="#editDialog{{$item->id}}">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
            </span>
            @if(!empty($delete))
            <span class="delete">
                <button type="submit" class="border-0 bg-transparent text-warning fw-bold" data-bs-toggle="modal" data-bs-target="#deleteDialog{{$item->id}}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </span>
            @endif
        </div>
    </div>
</div>
<x-editDialog :item="$item" :type="$type" />
<x-deleteDialog :item="$item" :type="$type" />