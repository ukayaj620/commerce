@extends('admin.home')

@section('menu')
<div class="d-flex flex-row w-100 align-items-center justify-content-between">
  <div class="d-flex flex-row">
    <a type="button" class="btn btn-info mr-3" style="width: fit-content;" href="{{ route('product.fetchAll') }}">Back</a>
    <h3>{{ $product->product_name }} Details</h3>
  </div>
  <div class="d-flex flex-row">
    <a
      type="button"
      class="btn btn-warning mr-3"
      href="{{ route('product.edit', ['id' => $product->id]) }}"
    >
      Edit
    </a>
    <form style="display:inline;" action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete ?')">Delete</button>
    </form>
  </div>
</div>
<div class="d-flex flex-row container justify-content-start container p-0 my-4">
  <div class="col-4 p-0">
    <img class="col-8 shadow rounded" src="{{ asset('storage/' . $product->product_image->image_path) }}">
  </div>
  <div class="col-8">
    <h5><strong>Nama Produk:</strong> {{ $product->product_name }}</h5>
    <h5><strong>Category:</strong> {{ $product->categories[0]->category_name }}</h5>
    <h5><strong>Harga:</strong> {{ $product->price }}</h5>
    <h5><strong>Berat:</strong> {{ $product->weight }}</h5>
    <h5><strong>Stock:</strong> {{ $product->stock }}</h5>
    <h5><strong>Deskripsi:</strong> <br> {{ $product->description }}</h5>
  </div>
</div>
@stop