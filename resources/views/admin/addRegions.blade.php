@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">
                        <code>Add Regions</code>


                    <div class="container rounded bg-white mt-5 mb-5">
                        <div class="row mt-2">

                            <form action="/admin/StoreRegion" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">

                                    <label>Region Name</label>

                                    <input type="text" id="name" name="name"
                                        class="form-control"required>
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
