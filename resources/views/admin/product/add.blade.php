@extends('admin.home')

@section('menu')
@if ($errors->any())
  <div class="alert alert-danger mb-2">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form class="container w-50 mb-4" method="POST" action="{{ route('product.create') }}" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="input-product-name">Nama Produk</label>
    <input type="text" class="form-control" id="input-product-name" name="product_name">
  </div>
  <div class="form-group">
    <label for="input-price">Price</label>
    <input type="text" class="form-control" id="input-price" name="price">
  </div>
  <div class="form-group">
    <label for="input-stock">Stock</label>
    <input type="text" class="form-control" id="input-stock" name="stock">
  </div>
  <div class="form-group">
    <label for="input-weight">Weight (gram)</label>
    <input type="text" class="form-control" id="input-weight" name="weight">
  </div>
  <div class="form-group">
    <label class="form-label fw-bold">Category</label>
    <select class="custom-select" id="input-category" name="category">
      @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
      @endforeach
    </select>
  </div>
  <input type="hidden" class="form-control" id="input-price" name="product_rate" value="0.0">
  <div class="form-group">
    <label for="input-description">Description</label>
    <textarea class="form-control" id="input-description" name="description"></textarea>
  </div>
  <p class="mb-2">Upload Product Photo</p>
  <div class="custom-file mb-4">
    <input type="file" class="custom-file-input" id="upload-image" name="image">
    <label class="custom-file-label" for="image">Choose file</label>
  </div>
  <button type="submit" class="btn btn-primary w-100">Add Product</button>
</form>
@stop