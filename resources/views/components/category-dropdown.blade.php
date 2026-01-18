<div class="dropdown text-center my-3">
    <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ isset($currentCategory) ? $currentCategory->name : 'Filter By Category' }}
    </button>
    <ul class="dropdown-menu">
        @foreach($categories as $category)
        <li><a class="dropdown-item" href="{{ url('/products?category='.$category->name) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>