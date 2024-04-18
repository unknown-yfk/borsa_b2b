@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">
                        <code>Add Cities</code>


                    <div class="container rounded bg-white mt-5 mb-5">
                        <div class="row mt-2">

                            <form action="/admin/StoreCity" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">

                                    <label>City Name</label>

                                    <input type="text" id="name" name="name" class="form-control"required>
                                </div>
                                <div class="mb-3">

                                    <label>Select Region</label>

                                    <select id="region_id" name="region_id" class="form-control form-control-sm" required>
                                        <option value=""></option>

                                        @foreach ($region as $p)
                                            <option value="{{ $p->id }}"> {{ $p->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
