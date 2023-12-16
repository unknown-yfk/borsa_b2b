@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Edit Products') }}</h4>

                            <p class="card-description">
                                <code> Edit Products Here!</code>
                            </p>
                            <form action="{{ url('/admin/editedProductTypeStore', $product_types->id) }}" method="POST"
                                enctype="multipart/form-data">
                                </center>
                                @csrf
                                <div class="mb-3">
                                    <label> Product Type Name</label>
                                    <input type="text" id="productTypeName" name="productTypeName"
                                        value="{{ $product_types->productTypeName }}" class="form-control">
                                </div>
                                <div class="mb-3"><label>Select Catagory</label>
                                    <select id="catagory" name="catagory" value="" class="form-control" required>
                                        <option value=""></option>
                                        @foreach ($catagory as $p)
                                            <option value="{{ $p->id }}"
                                                {{ $product_types->catagory_id === $p->id ? 'selected' : '' }}>
                                                {{ $p->catagoryName }}</option>
                                            {{-- <option value="{{$p->id}}"> {{Helper::get_CategoryName($p->id) }}</option> --}}
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label> Description</label>
                                    <input type="text" id="description" name="description"
                                        value="{{ $product_types->description }}"rows="5" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-outline-success" value="Update Product Type">
                                </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
@endsection
