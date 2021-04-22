@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($products as $product)
        <a href="{{ route('cart.product.detail', [ 'id' => $product->id ]) }}" class="card text-decoration-none text-reset shadow-sm rounded-lg mx-2 mb-4" style="width: 12rem;">
            <img src="{{ asset('storage/' . $product->product_image->image_path) }}" style="object-fit: cover; height: 12rem;" class="border-bottom card-img-top img-fluid img-thumbnail" alt="{{ $product->product_name }}">
            <div class="card-body p-2">
                <h5 class="card-title font-weight-bold">{{ $product->product_name }}</h5>
                <p class="p-0 align-text-justify" style="font-size: 0.75rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $product->description }}</p>
                <p class="card-text">Rp. {{ $product->price }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
