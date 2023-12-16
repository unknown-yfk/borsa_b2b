@extends('layouts.mainlayout')
@section('content')



<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{__('Edit Catagories')}}</h4>

                     <p class="card-description">
                  <code> Edit Catagories Here!</code>
                  </p>
                        <form action="{{url('/admin/editedcatagoryStore',$product_catagories->id)}}" method= "POST" enctype="multipart/form-data"></center>
                    @csrf
                    <div class="mb-3">
                     <label> Catagory Name</label>
                       <input type="text" id="catagoryName" name="catagoryName" value="{{ $product_catagories->catagoryName }}" class="form-control">
                    </div>

                    <div class="mb-3">
                     <label> Catagory Image</label>
                     <img src="../../../assets/catagory_img/{{$product_catagories->image}}" class="rounded float-start" alt="Product Catagory Image" width="100rem" height="100rem">
                       <input type="file" id="image"  name="image" class="form-control">
                       <input type="hidden" id="old_image"  name="old_image" value="{{$product_catagories->image}}">
                    </div>

                    <div class="mb-3">
                     <label> Description</label>
                    <input type="text"  id="description" name="description" value="{{ $product_catagories->description }}"rows="5" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <input type="submit" class="btn btn-outline-success" value="Update Catagory">

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
