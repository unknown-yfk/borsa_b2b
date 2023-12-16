@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-xs-2">
                          <form action="/agent/fetch_client_info/post" method="POST">
                             @csrf
                        <label><strong>Please enter the Client's Unique id : </strong></label><br><br>
                <input type="text" name="client_unique_id" id="client_unique_id" class="form-control" required><br>
                <button type="submit" class="btn btn-success mt-2">Submit</button>


                          </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
        @endsection
