@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Add ProductsList') }}</h4>
                            <form class="form-sample" action="/admin/StoreProductsList"method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <code>Add Products List here!</code><br><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.ProductName') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="name" name="name"
                                                    class="form-control" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.ProductImage') }}</label>
                                            <div class="col-sm-9">
                                                <input type="file" id="image" name="image"
                                                    class="form-control"required>

                                                @error('middleName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.Select_catagory') }}</label>
                                            <div class="col-sm-9">
                                                <select id="catagory" name="catagory" class="form-control form-control-sm"
                                                    required>
                                                    <option value=""></option>

                                                    @foreach ($catagories as $catagory)
                                                        <option value="{{ $catagory->id }}"
                                                            {{ old('catagory') == $catagory->id ? 'selected' : '' }}>
                                                            {{ $catagory->catagoryName }}</option>

                                                        {{-- value="{{ $businessTypes->id }}" {{ old('businessType') == $businessTypes->id ? 'selected' : '' }} --}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('lastName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.Select_product_type') }}</label>
                                            <div class="col-sm-9">
                                                <select name="adminproductType" id="adminproductType"
                                                    class="form-control form-control-sm"></select>
                                                @error('userName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.Quantity') }}</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="Qty" min="0" name="Qty"
                                                    class="form-control  @error('Qty') is-invalid @enderror"required>

                                                @error('Qty')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.Price') }}</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="price" name="price"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.0001" min="0"
                                                    class="form-control  @error('price') is-invalid @enderror"required>

                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.minorder') }}</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="min_order" name="min_order"
                                                     min="0"
                                                    class="form-control  @error('min_order') is-invalid @enderror"required>

                                                @error('min_order')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.maxorder') }}</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="max_order" name="max_order"

                                                    class="form-control  @error('max_order') is-invalid @enderror"required>

                                                @error('max_order')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.PackSize') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="packsize" name="packsize"
                                                    class="form-control  @error('packsize') is-invalid @enderror"required>

                                                @error('packsize')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>{{ __('messages.Description') }}</label>
                                            <div class="col-sm-9">
                                                <textarea id="description" name="description" rows="5" class="form-control"></textarea>


                                            </div>
                                        </div>

                                        <br>

                                    </div>





                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-outline-success" onsubmit="setTimeout()">
                                            {{ __('messages.Save') }}
                                        </button>
                                    </div>
                                </div>


                        </div>
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
