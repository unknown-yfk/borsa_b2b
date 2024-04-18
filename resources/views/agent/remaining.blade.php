@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-xs-2">


                        <label><strong>Remaining Amount :</strong></label><br><br>
                        <input type="number" name="remaining_amount" id="remaining_amount" class="form-control" value="{{$new_remaining}}" disabled required><br>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
