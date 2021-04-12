@extends('admin.home')

@section('menu')
<div style="container">
  <button 
    class="btn btn-primary float-right my-4"
    type="button"
    data-toggle="modal"
    data-target="#addCategory"
  >
    Add Category
  </button>
</div>

  <table class="table mt-4">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Category</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
        <tr>
          <td>{{ $category->category_name }}</td>
          <td>{{ $category->description }}</td>
          <td>
            <a
              type="button"
              class="btn btn-warning"
              data-toggle="modal"
              data-target="#editCategory"
            >
              Edit
            </a>
            <form style="display:inline;" action="{{ route('category.delete', ['id' => $category->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete ?')">Delete</button>
            </form>
          </td>
        </tr>
        <!-- Edit Category Modal  -->
        <div id="editCategory" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Input Category</h4>
              </div>
              <div class="modal-body">
                <form action="{{ route('category.update') }}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="hidden" class="form-control" name="id" required="1" value="{{ $category->id }}">
                  <div class="form-group">
                    <label>Category Name:</label>
                    <input type="text" class="form-control" name="category_name" required="1" value="{{ $category->category_name }}">
                  </div>
                  <div class="form-group">
                    <label>Description:</label>
                    <input type="text" class="form-control" name="description" required="1" value="{{ $category->description }}">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit">Confirm</button>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
      @endforeach
    </tbody>
  </table>

  <!-- Add Category Modal  -->
  <div id="addCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Category</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('category.create') }}" method="POST">
            @csrf
            <div class="form-group">
              <label>Category Name:</label>
              <input type="text" class="form-control" name="category_name" required="1">
            </div>
            <div class="form-group">
              <label>Description:</label>
              <input type="text" class="form-control" name="description" required="1">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Confirm</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection