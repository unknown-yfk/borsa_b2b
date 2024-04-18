@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit City</h4>

                            <p class="card-description">
                                <code> Edit Cities Here!</code>
                            </p>

                            <form action="{{ url('/admin/editedcityStore', $city[0]->id) }}" method= "POST"
                                enctype="multipart/form-data">
                                </center>
                                @csrf
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" value="{{ $city[0]->name }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3"><label>Select Region</label>
                                    <select id="region_id " name="region_id"  class="form-control" required>
                                        <option value="{{$city[0]->region_id}}">{{$city[0]->region}}</option>
                                        @foreach ($region as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-outline-success" value="Update City">

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
