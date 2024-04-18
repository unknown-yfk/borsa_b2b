@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-xs-2">

                     <form action="/repayment_pay" method="POST">
                             @csrf
                        <label><strong>Remaining Amount :</strong></label><br><br>
                        <input type="number" name="remaining_amount" id="remaining_amount" class="form-control" value="{{$loans[0]->remaining_amount}}" disabled required><br>
                        <label><strong>Repayment Amount :</strong></label><br><br>
                        <input type="number" name="repayment_amount" id="repayment_amount" class="form-control"  max="{{$loans[0]->remaining_amount}}" step="any" required><br>
                        <input type="hidden" name="id" id="id"  value="{{$loans[0]->id}}" class="form-control" />
                        <input type="hidden" name="remaining_amount" id="remaining_amount"  value="{{$loans[0]->remaining_amount}}" class="form-control" />
                        <button type="submit" class="btn btn-success mt-2">Pay</button>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
