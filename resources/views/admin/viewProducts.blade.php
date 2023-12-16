@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">




            <div class="container-fluid d-flex justify-content-center">


                <div class="row mt-5">
                    <h4 class="card-title">Product List</h4>
                    @foreach ($products as $product)
                        <div class="col-sm-3 mb-3">
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
                                    <div class="d-flex flex-row justify-content-between p-3 mid">
                                        {{-- <div class="d-flex flex-column"><small class="text-muted mb-1">Quantity</small><div class="d-flex flex-row"><small class="ghj">1.4L MultiAir</small><small class="ghj">16V I-4 Turbo</small></div></div></div> --}}
                                        <div class="d-flex flex-column"><small class="text-muted mb-2">Quantity :
                                                {{ $product->Qty }}</small></div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between p-3 mid">
                                        {{-- <div class="d-flex flex-column"><small class="text-muted mb-1">Quantity</small><div class="d-flex flex-row"><small class="ghj">1.4L MultiAir</small><small class="ghj">16V I-4 Turbo</small></div></div></div> --}}
                                        <div class="d-flex flex-column"><small class="text-muted mb-2">KD :
                                                {{ $product->firstName ." ". $product->middleName . " ". $product->lastName }}</small></div>
                                    </div>
                                    {{-- <small class="text-muted key pl-3">Standard key Features</small> --}}
                                    <div class="mx-3 mt-3 mb-2 btn-group">

                                        <a href="{{ url('admin/edit/product', $product->id) }}"><button type="button"
                                                class="btn btn-success btn-block mx-3"><small>EDIT</small></button></a>
                                        <a href="{{ url('admin/delete/product', $product->id) }}"><button type="button"
                                                class="btn btn-danger btn-block"
                                                onclick="return confirm('Do You Want To Delete This Product?')"><small>DELETE</i></small></button></a>
                                    </div>



                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>







        </div>
    </div>
@endsection
