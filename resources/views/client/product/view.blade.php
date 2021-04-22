@extends('layouts.app')

@section('content')
<div class="d-flex flex-row container align-items-center justify-content-between">
  <div class="d-flex flex-row">
    <a type="button" class="btn btn-info mr-3" style="width: fit-content;" href="{{ route('home') }}">Back</a>
    <h3>{{ $product->categories[0]->category_name }} >> <strong>{{ $product->product_name }}</strong></h3>
  </div>
</div>
<div class="d-flex flex-row container justify-content-start container p-0 my-4">
  <div class="col-4 p-0">
    <img class="shadow rounded" style="height: 20rem; width: 20rem;" src="{{ asset('storage/' . $product->product_image->image_path) }}">
  </div>
  <div class="col-8 d-flex flex-column">
    <div class="d-flex flex-row">
      <p class="mr-4 font-weight-bold col-2">Rating: </p>
      <div class="col-9">
        <div class="placeholder" style="color: lightgray;">
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            <span class="small">({{ $product->product_rate }})</span>
        </div>

        <div class="overlay" style="position: relative; top: -23px">
            
            @while($product->product_rate > 0)
                @if($product->product_rate > 0.5)
                    <i class="fas fa-star" style="color: orange;"></i>
                @else
                    <i class="fas fa-star-half" style="color: orange;"></i>
                @endif
                @php $product->product_rate--; @endphp
            @endwhile

        </div> 
      </div>
    </div>
    <div class="d-flex flex-row">
      <p class="mr-4 font-weight-bold col-2">Price: </p>
      <h5 class="font-weight-bold col-9" style="color: orange;">Rp. {{ $product->price }},-</h5>
    </div>
    <div class="d-flex flex-row align-items-center">
      <p class="mr-4 font-weight-bold mb-0 col-2">Quantity: </p>
      <!-- <h5 class="font-weight-bold" style="color: orange;">Rp. {{ $product->price }},-</h5> -->
      <div class="col-5">
        <div class="d-flex flex-row">
          <div class="input-group">
            <span class="input-group-prepend">
              <button type="button" class="btn btn-outline-secondary btn-number" data-type="minus" data-field="quantity">
                <span class="fa fa-minus"></span>
              </button>
            </span>
            <input type="text" name="quantity" class="form-control input-number" value="1" min="1" max="{{ $product->stock }}">
            <span class="input-group-append">
              <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus" data-field="quantity">
                <span class="fa fa-plus"></span>
              </button>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('js')
<script>

$('.btn-number').click(function(e){
    e.preventDefault();
    
    var fieldName = $(this).attr('data-field');
    var type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    var minValue = parseInt(input.attr('min'));
    var maxValue = parseInt(input.attr('max'));

    if(currentVal >= minValue) {
      $(".btn-number[data-type='minus'][data-field='"+name+"']").prop('disabled', false);
    } else {
      alert('Sorry, the minimum value was reached');
      $(this).val($(this).data('oldValue'));
    }
    if(currentVal <= maxValue) {
      $(".btn-number[data-type='plus'][data-field='"+name+"']").prop('disabled', false);
    } else {
      alert('Sorry, the maximum value was reached');
      $(this).val($(this).data('oldValue'));
    }

    if (!isNaN(currentVal)) {
      if(type == 'minus') {
          
        if(currentVal > input.attr('min')) {
            input.val(currentVal - 1).change();
        } 
        if(parseInt(input.val()) == input.attr('min')) {
            $(this).prop('disabled', true);
        }

      } else if(type == 'plus') {

        if(currentVal < input.attr('max')) {
            input.val(currentVal + 1).change();
        }
        if(parseInt(input.val()) == input.attr('max')) {
            $(this).prop('disabled', true);
        }

      }
    } else {
        input.val(0);
    }
});

$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});

$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
      $(".btn-number[data-type='minus'][data-field='"+name+"']").prop('disabled', false);
    } else {
      alert('Sorry, the minimum value was reached');
      $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
      $(".btn-number[data-type='plus'][data-field='"+name+"']").prop('disabled', false);
    } else {
      alert('Sorry, the maximum value was reached');
      $(this).val($(this).data('oldValue'));
    }
});

$(".input-number").keydown(function (e) {
  // Allow: backspace, delete, tab, escape, enter and .
  if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
    // Allow: Ctrl+A
    (e.keyCode == 65 && e.ctrlKey === true) || 
    // Allow: home, end, left, right
    (e.keyCode >= 35 && e.keyCode <= 39)) {
    // let it happen, don't do anything
      return;
  }
  if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
    e.preventDefault();
  }
});
</script>
@stop