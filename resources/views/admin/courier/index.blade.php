@extends('admin.home')

@section('menu')
<div style="container">
  <button 
    class="btn btn-primary float-right mb-4"
    type="button"
    data-toggle="modal"
    data-target="#addCourier"
  >
    Add Courier
  </button>
</div>

  <table class="table mt-4">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Logo</th>
        <th scope="col">Courier Name</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($couriers as $courier)
        <tr>
          <td>
            <img src="{{ asset('storage/' . $courier->courier_icon) }}" style="width:3rem; height: 3rem;">
          </td>
          <td>{{ $courier->courier_name }}</td>
          <td>
            <a
              type="button"
              class="btn btn-warning"
              data-toggle="modal"
              data-target="#editCourier"
            >
              Edit
            </a>
            <form style="display:inline;" action="{{ route('courier.delete', ['id' => $courier->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete ?')">Delete</button>
            </form>
          </td>
        </tr>

        <!-- Edit Courier Modal  -->
      <div id="editCourier" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Input Category</h4>
            </div>
            @if ($errors->any())
              <div class="alert alert-danger mb-2">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="modal-body">
              <form action="{{ route('courier.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" class="form-control" name="id" required="1" value="{{ $courier->id }}">
                <div class="form-group">
                  <label>Courier Name:</label>
                  <input type="text" class="form-control" name="courier_name" required="1" value="{{ $courier->courier_name }}">
                </div>
                <p class="mb-2">Upload Courier Logo</p>
                <div class="custom-file mb-4">
                  <input type="file" class="custom-file-input" id="upload-image" name="image">
                  <label class="custom-file-label" for="image">{{ $courier->courier_icon }}</label>
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

  <!-- Add Courier Modal  -->
  <div id="addCourier" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Courier Data</h4>
        </div>
        @if ($errors->any())
          <div class="alert alert-danger mb-2">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="modal-body">
          <form action="{{ route('courier.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Courier Name:</label>
              <input type="text" class="form-control" name="courier_name" required="1">
            </div>
            <p class="mb-2">Upload Courier Logo</p>
            <div class="custom-file mb-4">
              <input type="file" class="custom-file-input" id="upload-image" name="image">
              <label class="custom-file-label" for="image">Choose file</label>
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
@stop