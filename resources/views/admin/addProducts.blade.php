
@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">

        <div class="content-wrapper">




            <div class="container-fluid d-flex justify-content-center">
                <div class="row">
                    <h3 class="card-title">Product List</h3>
                    @foreach ($products as $product)
                        <div class="col-sm-4 mb-3 mt-3">
                            <div class="card">
                                <img src="{{ asset('/assets/product_img/' . $product->image) }}" class="card-img-top"
                                    width="100%">
                                <div class="card-body pt-0 px-0">
                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                        <small class="text-muted mt-1">{{ $product->packsize }}</small>
                                        <h6>{{ $product->price }} Birr</h6>
                                    </div>
                                    <hr class="mt-2 mx-3">
                                    <div class="d-flex flex-column px-2"><span
                                            class="text-muted"><strong>{{ $product->name }}</strong></span></div><br>

                                    <div class="d-flex flex-row justify-content-between px-3 pb-4">

                                        <div class="d-flex flex-column"><span
                                                class="text-muted">{{ $product->description }}</span></div><br>

                                    </div>
                                    <div class="d-flex flex-row justify-content-between p-3 pb-1 mid">
                                        {{-- <div class="d-flex flex-column"><small class="text-muted mb-1">Quantity</small><div class="d-flex flex-row"><small class="ghj">1.4L MultiAir</small><small class="ghj">16V I-4 Turbo</small></div></div></div> --}}
                                        <div class="d-flex flex-column"><small class="text-muted mb-2">Available :
                                                {{ $product->Qty }}</small></div>
                                    </div>

                                    <form action="/admin/StoreProducts" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="id">

                                        <input type="hidden" value="{{ $product->description }}" name="description">

                                        <input type="hidden" value="{{ $product->catagory_id }}" name="catagory">
                                        <input type="hidden" value="{{ $product->productType_id }}"
                                            name="adminproductType">
                                        <input type="hidden" value="{{ $product->image }}" name="image">
                                        <input type="hidden" value="{{ $product->packsize }}" name="packsize">
                                        <input type="hidden" value="{{ $product->price }}" name="price">
                                        <input type="hidden" value="{{ $product->name }}" name="name">
                                        <small class="text-muted key pl-3">Insert quantity here : </small><br>

                                        <div>

                                            <input type="number" id="Qty" name="Qty"
                                                class="form-control ml-3  @error('Qty') is-invalid @enderror"required>

@error('Qty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label>Select Key Distrbutor</label>
                                        <div class="col-sm-9">
                                            <select id="Kd_id" name="Kd_id" class="form-control form-control-sm"
                                                required>
                                                <option value=""></option>
                                                @foreach ($key_distro as $kd)
                                                    <option value="{{ $kd->id }}"> {{ $kd->firstName }}
                                                        {{ $kd->middleName }} {{ $kd->lastName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <small class="text-muted key pl-3">Standard key Features</small> --}}
                                        {{-- <div class="mx-3 mt-3 mb-2 btn-group">
                                        <a href="{{ url('kd/add/stock_store', $product->id) }}"><button type="button"
                                                class="btn btn-success btn-block "><small>ADD TO STOCK</small></button></a>
                                        {{-- <a href="{{url('admin/delete/product',$product->id)}}"><button type="button" class="btn btn-danger btn-block" onclick="return confirm('Do You Want To Delete This Product?')"><small>DELETE</i></small></button></a> --}}
                                        {{-- </div>  --}}

                                        <div class="col-md-6 mx-4">
                                            <input type="submit" class="btn btn-outline-success" value="ADD TO STOCK">
                                        </div>
                                      </form>



                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>







        </div>
    </div>
@endsection
