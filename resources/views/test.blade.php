@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <!-- Collapse Test -->
    <button class="btn btn-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#demo">
        Toggle Collapse
    </button>
    <div id="demo" class="collapse">
        <div class="card card-body">Collapse works!</div>
    </div>

    <!-- Dropdown Test -->
    <div class="dropdown mt-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            Dropdown test
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
        </ul>
    </div>

    <!-- Modal Test -->
    <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#modalTest">
        Open Modal
    </button>
    <div class="modal fade" id="modalTest" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Bootstrap 5 JS is working!
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
