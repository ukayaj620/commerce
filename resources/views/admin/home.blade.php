@extends('layouts.app')

@section('content')
<div class="d-flex w-100 container-fluid p-0">
    <div class="col-3 p-0">
        <div style="position: fixed; z-index: 1; top: 55px;" class="bg-light border-light d-flex flex-column col-3">
            <a href="#" class="col-12 list-group-item list-group-item-action active" aria-current="true">
                Category
            </a>
            <a href="#" class="col-12 list-group-item list-group-item-action">Product</a>
        </div>
    </div>
    <div class="col-9">
        @yield('menu')
    </div>
</div>
@endsection
