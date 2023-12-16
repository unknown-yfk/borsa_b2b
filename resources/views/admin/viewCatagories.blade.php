{{-- @extends('layouts.mainlayout')
@section('content')

<div class="main-panel">
        <div class="content-wrapper">




            <div class="container-fluid d-flex justify-content-center">


  <div class="row mt-5">
     <h4 class="card-title">Catagory List</h4>
                        @foreach ($product_catagories as $catagory)



  <div class="col-sm-3 mb-3">
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

      <div class="mx-3 mt-3 mb-2 btn-group">
        <a href ="{{url('admin/edit/catagory',$catagory->id)}}"><button type="button" class="btn btn-success btn-block mx-3"><small>EDIT</small></button></a>
        <a href="{{url('admin/delete/catagory',$catagory->id)}}"><button type="button" class="btn btn-danger btn-block" onclick="return confirm('Do You Want To Delete This Catagory?')"><small>DELETE</i></small></button></a>
    </div>



    </div>
  </div>

    </div>
  @endforeach

  </div>
</div>
@endsection --}}

@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">


            <div class="container mt-100">




                <div class="row">
                    @foreach ($product_catagories as $catagory)

                        <div class="col-md-3 col-sm-6">
                            <div class="card mb-30"><a class="card-img-tiles" href="#" data-abc="true">
                                    <div class="inner">
                                        <img src="{{ asset('/assets/catagory_img/' . $catagory->image) }}"
                                            class="card-img-top" width="100%">
                                        {{-- <div class="main-img"><img src="https://i.imgur.com/O0GMYuw.jpg" alt="Category"></div> --}}
                                        {{-- <div class="thumblist"><img src="https://i.imgur.com/ILEU18M.jpg" alt="Category"><img src="https://i.imgur.com/2kePJmX.jpg" alt="Category"></div> --}}
                                    </div>
                                </a>
                                <div class="card-body text-center">
                                    <h4 class="card-title">{{ $catagory->catagoryName }}</h4>
                                    <p class="text-muted">{{ $catagory->description }}</p>
                                    {{-- <a class="btn btn-outline-primary btn-sm"
                                        href="#" data-abc="true">View Products</a> --}}
                                           <div class="mx-3 mt-3 mb-2 btn-group">
        <a href ="{{url('admin/edit/catagory',$catagory->id)}}"><button type="button" class="btn btn-success btn-block "><small>EDIT</small></button></a>
        <a href="{{url('admin/delete/catagory',$catagory->id)}}"><button type="button" class="btn btn-danger btn-block mx-2" onclick="return confirm('Do You Want To Delete This Catagory?')"><small>DELETE</i></small></button></a>
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
