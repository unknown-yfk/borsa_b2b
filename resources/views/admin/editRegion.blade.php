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
                  <code> Edit Regions Here!</code>
                  </p>
                        <form action="{{url('/admin/editedregionStore',$region->id)}}" method= "POST" enctype="multipart/form-data"></center>
                    @csrf
                    <div class="mb-3">
                     <label>Name</label>
                       <input type="text" id="name" name="name" value="{{ $region->name }}" class="form-control">
                    </div>


                    <div class="col-md-6">
                        <input type="submit" class="btn btn-outline-success" value="Update Region">

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
