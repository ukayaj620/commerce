@extends('layouts.app')

@section('content')
<div class="d-flex w-100 container-fluid p-0">
    <div class="col-3 p-0">
        <div id="sidenav" style="position: fixed; z-index: 1; top: calc(55px + 2rem);" class="bg-light border-light d-flex flex-column col-3">
            <a href="{{ route('category.fetchAll') }}" class="col-12 list-group-item list-group-item-action" aria-current="true">
                Category
            </a>
            <a href="{{ route('product.fetchAll') }}" class="col-12 list-group-item list-group-item-action">Product</a>
        </div>
    </div>
    <div class="col-9">
        @yield('menu')
    </div>
</div>
@stop

@section('js')
<script>
$(document).ready(function () {
    var url = window.location;
    $('#sidenav a[href="'+ url +'"]').addClass('active');
    $('#sidenav a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');
});
</script>
@stop
