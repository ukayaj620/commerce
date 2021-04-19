@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($products as $product)
        <a href="" class="card text-decoration-none text-reset shadow-sm rounded-lg mx-2" style="width: 12rem;">
            <img src="{{ asset('storage/' . $product->product_image->image_path) }}" style="object-fit: cover; height: 12rem;" class="border-bottom card-img-top img-fluid img-thumbnail" alt="{{ $product->product_name }}">
            <div class="card-body p-2">
                <h5 class="card-title font-weight-bold">{{ $product->product_name }}</h5>
                <p class="card-text">Rp. {{ $product->price }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
