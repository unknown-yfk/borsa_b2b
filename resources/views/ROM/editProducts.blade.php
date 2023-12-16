@extends('layouts.mainlayout')
@section('content')
    @if (Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif


    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Edit data') }}</h4>

                            <p class="card-description">
                                <code> Edit data Here!</code>
                            </p>

                            <form action="{{ url('/rom/edit/product/post', $data[0]->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf


                                <div class="mb-3">
                                    <label><strong> Product Name</strong></label>
                                    <input type="text" id="name" name="name" value="{{ $data[0]->name }}"
                                        class="form-control" readonly>
                                        <input type="hidden" id="productlist_id" name="productlist_id" value="{{ $data[0]->productlist_id }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label><strong> Product Image</strong></label>
                                  <img src="../../../assets/product_img/{{$data[0]->image}}" class="rounded float-start" alt="Product Image" width="100rem" height="100rem">
                                   <input type="file" id="image" name="image" class="form-control">
                                   <input type="hidden" id="old_image"  name="old_image" value="{{$data[0]->image}}">
                                </div>

                                <div class="mb-3"><label>Catagory</label>
                                    <input type="text" id="name" name="name" value="{{ $data[0]->catagoryName }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="mb-3"><label>Product Type</label>
                                    <input type="text" id="name" name="name" value="{{ $data[0]->productTypeName }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label><strong> Price</strong></label>
                                    <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" id="price"
                                        name="price"
                                        value="{{ $data[0]->price }}"class="form-control  @error('packsize') is-invalid @enderror"required
                                        readonly>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label><strong> Quantity</strong></label>
                                    <input type="number" id="Qty" name="Qty"
                                        value="{{ $data[0]->Qty }}"class="form-control  @error('Qty') is-invalid @enderror"required>


@error('Qty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label><strong>Pack-Size</strong></label>
                                    <input id="packsize" name="packsize"
                                        value="{{ $data[0]->packsize }}"class="form-control  @error('packsize') is-invalid @enderror"required
                                        readonly>

                                    @error('packsize')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label><strong>Description</strong></label>
                                    <input type="text" id="description" name="description"
                                        value="{{ $data[0]->description }}"rows="5" class="form-control" required
                                        readonly>
                                </div>
                                <input type="hidden" name="old_image" value="{{ $data[0]->image }}">
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
            $("#productType").html('');
            $.ajax({
                url: "{{ url('api/fetch-productType') }}",
                type: "POST",
                data: {
                    catagory_id: idCatagory,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#productType').html('<option value=""></option>');
                    $.each(result.productTypes, function(key, value) {
                        $("#productType").append('<option value="' + value
                            .id + '">' + value.productTypeName + '</option>');
                    });
                    // $('#city-dropdown').html('<option value="">-- Select City --</option>');
                }
            });
        });


//              $('#productType').on('change', function () {
        //         var idState = this.value;
        //         $("#city-dropdown").html('');
        //         $.ajax({
        //             url: "{{ url('api/fetch-cities') }}",
        //             type: "POST",
        //             data: {
        //                 state_id: idState,
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             dataType: 'json',
        //             success: function (res) {
        //                 $('#city-dropdown').html('<option value="">-- Select City --</option>');
        //                 $.each(res.cities, function (key, value) {
        //                     $("#city-dropdown").append('<option value="' + value
        //                         .id + '">' + value.name + '</option>');
        //                 });
        //             }
        //         });
        //     });

        // });
    });
</script>
