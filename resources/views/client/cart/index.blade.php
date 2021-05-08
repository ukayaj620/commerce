@extends('layouts.app')

@section('content')
<div class="container d-flex flex-wrap justify-content-center">
  @if($is_empty == true)
    <div class="container d-flex flex-column justify-content-center align-items-center">
      <img class="col-3 mt-4" src="{{ asset('storage/empty_cart.svg') }}" alt="cart is empty">
      <h3 class="font-weight-bold mt-3">Cart is Empty</h3>
    </div>
  @else
    @foreach ($cart->products as $product)
      <div class="card text-decoration-none text-reset shadow-sm rounded-lg mx-2 mb-4" style="width: 12rem;">
        <img src="{{ asset('storage/' . $product->product_image->image_path) }}" style="object-fit: cover; height: 12rem;" class="border-bottom card-img-top img-fluid img-thumbnail" alt="{{ $product->product_name }}">
        <div class="card-body p-2">
          <h5 class="card-title font-weight-bold">{{ $product->product_name }}</h5>
          <p class="p-0 mb-0">Price: Rp. {{ $product->price }},-</p>
          <p class="card-text">In Cart: {{ $product->pivot->qty }}</p>
          <a type="button" class="btn btn-primary w-100" href="{{ route('cart.fetch.detail', [ 'id' => $product->id ]) }}">See Details</a>
        </div>
      </div>
    @endforeach
  @endif
</div>
@stop