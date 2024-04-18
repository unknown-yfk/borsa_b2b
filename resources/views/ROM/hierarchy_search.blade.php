@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-xs-2">
                        <form action="/delivery_hierarchy/post" method="POST">
                            @csrf
                            <label><strong> Handover To: </strong></label><br><br>
                            <select id="hierarchy" name="hierarchy" class="form-control" required>
                                <option value="client">Client</option>
                               <option value="cico">CICO</option>
                            </select>
                            {{-- <input type="text" name="client_unique_id" id="client_unique_id" class="form-control"
                                required><br> --}}
                            <button type="submit" class="btn btn-success mt-2">Search</button>


                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
