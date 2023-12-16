
@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">


            <div class="container mt-100">




                <div class="row">
                    {{-- @foreach ($product_catagories as $catagory) --}}
     <h4 class="card-title">Catagories </h4>
                        @foreach ($productsCatagories as $catagory)



  <div class="col-sm-3 mb-3 mt-4">
    <div class="card">
    <img src="{{ asset('/assets/catagory_img/'.$catagory->image) }}" class="card-img-top" width="100%">
    <div class="card-body pt-0 px-0">
      <div class="d-flex flex-row justify-content-between mb-0 px-3">

      </div>
      <hr class="mt-2 mx-3">
      <div class="d-flex flex-column px-2"><span class="text-muted"><strong>{{ $catagory->catagoryName }}</strong></span></div><br>

      <div class="d-flex flex-row justify-content-between px-3 pb-4">

        <div class="d-flex flex-column"><span class="text-muted">{{ $catagory->description }}</span></div><br>

      </div>

        {{-- <form action="{{url('product/category',$catagory->id , $cli_id )}}" method="GET">
            {{ $cli_id }}
                    <input type="hidden" value="{{ $cli_id }}" name="clients_user_id">


                                        <button class="btn btn-success btn-block mx-3"><small>View Products</small></button>
                                    </form> --}}
                                    <a href="{{ url('product/category', [$catagory->id, $cli_id]) }}" class="btn btn-success btn-block mx-3">
  <small>View Products</small>
</a>



    </div>
  </div>

    </div>
    @endforeach

                </div>
            </div>


        </div>
    </div>
@endsection
