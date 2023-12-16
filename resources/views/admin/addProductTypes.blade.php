
@extends('layouts.mainlayout')
@section('content')



<div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                  {{-- <h4 class="card-title">{{__('messages.AddCatagories')}}</h4> --}}

                  <p class="card-description">
                  <code>Add Product Types here!</code>


                         <div class="container rounded bg-white mt-5 mb-5">
                                <div class="row mt-2">
                                    <center>
                        <form action="{{url('admin/StoreProductTypes')}}" method= "POST" enctype="multipart/form-data"></center>
                    @csrf
                    <div class="mb-3">

                    <label>{{__('messages.ProductTypeName')}}</label>

                       <input type="text" id="productTypeName" name="productTypeName" class="form-control"required>
                    </div>

                    <div class="mb-3">

                          <label>{{__('messages.Select_catagory')}}</label>

                       <select id="catagory" name="catagory" class="form-control form-control-sm" required>
                                <option value=""></option>

                             @foreach($catagory as $p)
                                <option value="{{$p->id}}"> {{$p->catagoryName }}
                                </option>
                             @endforeach
                        </select>
                    </div>

                    <div class="mb-3">

                          <label>{{__('messages.Description')}}</label>

                       <textarea id="description" name="description" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-outline-success">{{__('messages.Save')}}</button>

                     </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        </div></div>
 </div>
@endsection























