@extends('layouts.mainlayout')
@section('content')

<div class="main-panel">
        <div class="content-wrapper">




            <div class="container-fluid d-flex justify-content-center">
                {{-- <h4 class="card-title">{{__('Add Products')}}</h4> --}}

  <div class="row mt-5">
     <h4 class="card-title">Product Type List</h4>
                        @foreach ($product_types as $type)

    {{-- <div class="col-sm-4 mb-3">

      <div class="card">
    <img src="https://imgur.com/edOjtEC.png" class="card-img-top" width="100%">
    <div class="card-body pt-0 px-0">
      <div class="d-flex flex-row justify-content-between mb-0 px-3">
        <small class="text-muted mt-1">STARTING AT</small>
        <h6>&dollar;{{ $product->price }} &ast;</h6>
      </div>
      <hr class="mt-2 mx-3">
      <div class="d-flex flex-row justify-content-between px-3 pb-4">
        <div class="d-flex flex-column"><span class="text-muted">Fuel Efficiency</span><small class="text-muted">L/100KM&ast;</small></div>
        <div class="d-flex flex-column"><h5 class="mb-0">8.5/7.1</h5><small class="text-muted text-right">(city/Hwy)</small></div>
      </div>
      <div class="d-flex flex-row justify-content-between p-3 mid">
        <div class="d-flex flex-column"><small class="text-muted mb-1">ENGINE</small><div class="d-flex flex-row"><img src="https://imgur.com/iPtsG7I.png" width="35px" height="25px"><div class="d-flex flex-column ml-1"><small class="ghj">1.4L MultiAir</small><small class="ghj">16V I-4 Turbo</small></div></div></div>
        <div class="d-flex flex-column"><small class="text-muted mb-2">HORSEPOWER</small><div class="d-flex flex-row"><img src="https://imgur.com/J11mEBq.png"><h6 class="ml-1">135 hp&ast;</h6></div></div>
      </div>
      <small class="text-muted key pl-3">Standard key Features</small>
      <div class="mx-3 mt-3 mb-2"><button type="button" class="btn btn-danger btn-block"><small>BUILD & PRICE</small></button></div>
      <small class="d-flex justify-content-center text-muted">*Legal Disclaimer</small>
    </div>
  </div>
    </div> --}}

  <div class="col-sm-3 mb-3">
    <div class="card">

    <div class="card-body pt-0 px-0">
      <div class="d-flex flex-row justify-content-between mb-0 px-3">
        {{-- <small class="text-muted mt-1">{{ $product->packsize}}</small> --}}
        {{-- <h6>{{ $product->price }} Birr</h6> --}}
      </div>
      <hr class="mt-2 mx-3">
      <div class="d-flex flex-column px-2"><span class="text-muted"><strong>{{ $type->productTypeName }}</strong></span></div><br>
                                <h6 class="text-gray-500 px-2"><strong>Category : </strong>{{ Helper::get_CategoryName($type->catagory_id) }}</h6><br>


      <div class="d-flex flex-row justify-content-between px-3 pb-4">

        <div class="d-flex flex-column"><span class="text-muted">{{ $type->description }}</span></div><br>

      </div>
      {{-- <div class="d-flex flex-row justify-content-between p-3 mid"> --}}
        {{-- <div class="d-flex flex-column"><small class="text-muted mb-1">Quantity</small><div class="d-flex flex-row"><small class="ghj">1.4L MultiAir</small><small class="ghj">16V I-4 Turbo</small></div></div></div> --}}
        {{-- <div class="d-flex flex-column"><small class="text-muted mb-2">Quantity : {{ $product->Qty }}</small></div> --}}
      {{-- </div> --}}
      {{-- <small class="text-muted key pl-3">Standard key Features</small> --}}
      <div class="mx-3 mt-3 mb-2 btn-group">
        <a href ="{{url('admin/edit/productType',$type->id)}}"><button type="button" class="btn btn-success btn-block mx-3"><small>EDIT</small></button></a>
        <a href="{{url('admin/delete/productType',$type->id)}}"><button type="button" class="btn btn-danger btn-block" onclick="return confirm('Do You Want To Delete This Product Type?')"><small>DELETE</i></small></button></a>
    </div>



    </div>
  </div>

    </div>
  @endforeach

  </div>
</div>
@endsection
