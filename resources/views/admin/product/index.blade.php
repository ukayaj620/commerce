@extends('admin.home')

@section('menu')
<div style="container">
  <a 
    class="btn btn-primary float-right mb-4"
    type="button"
    href="{{ route('product.add') }}"
  >
    Add Product
  </a>
</div>
  <table class="table mt-4">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Product Name</th>
        <th scope="col">Price</th>
        <th scope="col">Product Rate</th>
        <th scope="col">Stock</th>
        <th scope="col">Weight</th>
        <th scope="col">Category</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr>
          <td>{{ $product->product_name }}</td>
          <td>{{ $product->price }}</td>
          <td>{{ $product->product_rate }}</td>
          <td>{{ $product->stock }}</td>
          <td>{{ $product->weight }}</td>
          <td>
            <ul style="list-style-type: none; padding: 0;">
            @foreach ($product->categories as $product_category)
              <li>{{ $product_category->category_name }}</li>
            @endforeach
            </ul>
          </td>
          <td>
            <a
              type="button"
              class="btn btn-info"
              href="{{ route('product.byId', ['id' => $product->id]) }}"
            >
              View
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop