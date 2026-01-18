<div class="dropdown text-center my-3 mt-md-5">
    <button class="btn btn-outline-success dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ isset($currentStatus) ? $currentStatus : 'Filter By Status' }}
    </button>
    <ul class="dropdown-menu w-100">
        @foreach($statuses as $status)
        <li>
            @if(auth()->id() == 2)
            <a 
                class="dropdown-item" 
                href="/orders/?status={{$status}}{{request('from_date')?'&from_date='.request('from_date'):''}}{{request('to_date')?'&to_date='.request('to_date'):''}}">
                {{ $status }}
            </a>
            @elseif(auth()->id() ==1)
            <a 
                class="dropdown-item" 
                href="/user/{{auth()->id()}}/orders/?status={{$status}}{{request('from_date')?'&from_date='.request('from_date'):''}}{{request('to_date')?'&to_date='.request('to_date'):''}}">
                {{ $status }}
            </a>
            @endif
        </li>
        @endforeach
    </ul>
</div>