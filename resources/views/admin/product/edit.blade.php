@extends('admin.home')

@section('menu')
<div class="d-flex flex-row w-100 align-items-center justify-content-between">
  <div class="d-flex flex-row">
    <a type="button" class="btn btn-info mr-3" style="width: fit-content;" href="{{ route('product.fetchAll') }}">Back</a>
    <h3>Edit {{ $product->product_name }} Product</h3>
  </div>
</div>
<div class="d-flex flex-row container justify-content-start container p-0 my-4">
  <div class="col-4 p-0">
    <img class="col-8 shadow rounded" src="{{ asset('storage/' .$product->product_image->image_path) }}">
  </div>
  <div class="col-8">
    @if ($errors->any())
      <div class="alert alert-danger mt-2">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form class="container w-75 mb-4" method="POST" action="{{ route('product.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" class="form-control" id="input-product-name" name="id" value="{{ $product->id }}">
      <div class="form-group">
        <label for="input-product-name">Nama Produk</label>
        <input type="text" class="form-control" id="input-product-name" name="product_name" value="{{ $product->product_name }}">
      </div>
      <div class="form-group">
        <label for="input-price">Price</label>
        <input type="text" class="form-control" id="input-price" name="price" value="{{ $product->price }}">
      </div>
      <div class="form-group">
        <label for="input-stock">Stock</label>
        <input type="text" class="form-control" id="input-stock" name="stock" value="{{ $product->stock }}">
      </div>
      <div class="form-group">
        <label for="input-weight">Weight (gram)</label>
        <input type="text" class="form-control" id="input-weight" name="weight" value="{{ $product->weight }}">
      </div>
      <div class="form-group">
        <label class="form-label fw-bold">Category</label>
        <select class="custom-select" id="input-category" name="category">
          @foreach ($categories as $category)
            @if($category->id == $product->categories[0]->id)
              <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
            @else
              <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endif
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="input-description">Description</label>
        <textarea class="form-control" id="input-description" name="description">{{ $product->description }}</textarea>
      </div>
      <p class="mb-2">Upload Product Photo</p>
      <div class="custom-file mb-4">
        <input type="file" class="custom-file-input" id="upload-image" name="image">
        <label class="custom-file-label" for="image">Choose file</label>
      </div>
      <button type="submit" class="btn btn-primary w-100">Update Product</button>
    </form>
  </div>
</div>
@stop