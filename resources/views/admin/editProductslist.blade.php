@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Edit Products') }}</h4>

                            <p class="card-description">
                                <code> Edit Products Here!</code>
                            </p>
                            <form action="{{ url('/admin/editedProductlistStore', $products->id) }}" method="POST"
                                enctype="multipart/form-data">
                                </center>
                                @csrf
                                <div class="mb-3">
                                    <label> Product Name</label>
                                    <input type="text" id="name" name="name" value="{{ $products->name }}"
                                        class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label> Product Image</label>
                                    <img src="{{ asset('/assets/product_img/' . $products->image) }}"
                                        class="rounded float-start" alt="Product Image" width="100rem" height="100rem">
                                    <input type="file" id="image" name="image" class="form-control">
                                    <input type="hidden" id="old_image" name="old_image" value="{{ $products->image }}">
                                </div>

                                <div class="mb-3"><label>Select Catagory</label>

                                    <select id="catagory" name="catagory" class="form-control" required>

                                        {{-- @if (!empty($countries)) --}}
                                        @foreach ($catagories as $catagory)
                                            {{-- <option value=""></option> --}}

                                            <option value="{{ $catagory->id }}"
                                                {{ $products->catagory_id == $catagory->id ? 'selected' : '' }}>
                                                {{ $catagory->catagoryName }}</option>
                                            {{-- <option value="{{$p->id}}" {{$product_types->catagory_id === $p->id ? 'selected' : '' }}>{{ $p->catagoryName}}</option> --}}

                                            {{-- </option> --}}
                                        @endforeach
                                        {{-- @endif --}}
                                    </select>
                                </div>

                                <div class="mb-3"><label>Select Product Type</label>

                                    <select name="adminproductType" id="adminproductType" class="form-control">

                                        @foreach ($productType as $p)
                                            {{-- <option value=""></option> --}}

                                            <option value="{{ $p->id }}"
                                                {{ $products->productType_id == $p->id ? 'selected' : '' }}>
                                                {{ $p->productTypeName }}</option>
                                            {{-- <option value="{{$p->id}}" {{$product_types->catagory_id === $p->id ? 'selected' : '' }}>{{ $p->catagoryName}}</option> --}}

                                            {{-- </option> --}}
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Price</label>
                                    <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.0001" id="price"
                                        name="price" value="{{ $products->price }}"class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Quantity</label>
                                    <input type="number" id="Qty" name="Qty"
                                        value="{{ $products->Qty }}"class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>{{ __('messages.minorder') }}</label>
                                        <div class="col-sm-9">
                                            <input type="number" id="min_order" name="min_order" min="0"
                                                value="{{ $products->min_order }}"
                                                class="form-control  @error('min_order') is-invalid @enderror"required>

                                            @error('min_order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>{{ __('messages.maxorder') }}</label>

                                    <input type="number" id="max_order" name="max_order"
                                        value="{{ $products->max_order }}"
                                        class="form-control  @error('max_order') is-invalid @enderror"required>

                                    @error('max_order')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Pack-Size</label>
                                    <input id="packsize" name="packsize"
                                        value="{{ $products->packsize }}"class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <input type="text" id="description" name="description"
                                        value="{{ $products->description }}"rows="5" class="form-control" required>
                                </div>
                                <input type="hidden" name="old_image" value="{{ $products->image }}">
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-outline-success" value="Update Product">
                                </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        /*------------------------------------------
        --------------------------------------------
        Country Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#catagory').on('change', function() {
            var idCatagory = this.value;
            $("#adminproductType").html('');
            $.ajax({
                url: "{{ url('api/admin/fetch-productType') }}",
                type: "POST",
                data: {
                    catagory_id: idCatagory,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#adminproductType').html('<option value=""></option>');
                    $.each(result.productTypes, function(key, value) {
                        $("#adminproductType").append('<option value="' + value
                            .id + '">' + value.productTypeName + '</option>');
                    });

                }
            });
        });


    });
</script>


{{-- <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script>
    $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
   });

   $(document).ready(function(){
        $("#catagory").change(function(){
            var country_id = $(this).val();

            if (country_id == "") {
                var country_id = 0;
            }

            $.ajax({
                url: '{{ url("/fetch-states/") }}/'+country_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    $('#state').find('option:not(:first)').remove();
                    $('#city').find('option:not(:first)').remove();

                    if (response['states'].length > 0) {
                        $.each(response['states'], function(key,value){
                            $("#state").append("<option value='"+value['id']+"'>"+value['name']+"</option>")
                        });
                    }
                }
            });
        });
    })
</script> --}}
