@extends('layouts.app')

@section('content')
<div class="container">
    <div class="wrap justify-content-center">
        @foreach ($products as $product)
        <a href="" class="card text-decoration-none text-reset shadow-sm rounded-lg" style="width: 12rem;">
            <img src="{{ asset('storage/' . $product->product_image->image_path) }}" class="border-bottom card-img-top" alt="{{ $product->product_name }}">
            <div class="card-body p-2">
                <h5 class="card-title font-weight-bold">{{ $product->product_name }}</h5>
                <p class="card-text">Rp. {{ $product->price }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
