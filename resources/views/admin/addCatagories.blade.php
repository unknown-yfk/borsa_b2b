@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">{{__('messages.AddCatagories')}}</h4> --}}

                    <p class="card-description">
                        <code>{{ __('messages.AddCatagories') }}!</code>


                    <div class="container rounded bg-white mt-5 mb-5">
                        <div class="row mt-2">

                            <form action="/admin/StoreCatagories" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">

                                    <label>{{ __('messages.CatagoryName') }}</label>

                                    <input type="text" id="catagoryName" name="catagoryName"
                                        class="form-control"required>
                                </div>

                                <div class="mb-3">

                                    <label>{{ __('messages.CatagoryImage') }}</label>

                                    <input type="file" id="image" name="image" class="form-control"required>
                                </div>

                                <div class="mb-3">

                                    <label>{{ __('messages.Description') }}</label>

                                    <textarea id="description" name="description" rows="5" class="form-control"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <button type="submit"
                                        class="btn btn-outline-success">{{ __('messages.Save') }}</button>

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
