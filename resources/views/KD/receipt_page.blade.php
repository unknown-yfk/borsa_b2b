{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->
@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
<div class="container">
	<div class="row">

        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3 bg-info">
            {{-- <div class="row">
    			<div class="receipt-header">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="receipt-left">
							<img class="img-responsive" alt="iamgurdeeposahan" src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg" style="width: 71px; border-radius: 43px;">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 text-right">
						<div class="receipt-right">
							<h5>TechiTouch.</h5>
							<p>+91 12345-6789 <i class="fa fa-phone"></i></p>
							<p>info@gmail.com <i class="fa fa-envelope-o"></i></p>
							<p>Australia <i class="fa fa-location-arrow"></i></p>
						</div>
					</div>
				</div>
            </div> --}}
            <input type="hidden" {{$date=0;}}/>
             @foreach ($orderedProducts as $p)

                  <input type="hidden" {{$date=$p->createdDate;}}/>
             @endforeach
             DATE - {{$date}}
			<div class="row">
				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						{{-- <div class="receipt-right">
							<h5>Gurdeep Singh <small>  |   Lucky Number : 156</small></h5>
							<p><b>Mobile :</b> +91 12345-6789</p>
							<p><b>Email :</b> info@gmail.com</p>
							<p><b>Address :</b> Australia</p>
						</div> --}}
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
							<h1>Receipt</h1>
						</div>
					</div>
				</div>
            </div>

            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                             @php
                                        $totalSum = 0;
                                    @endphp
                        @foreach ($orderedProducts as $p)
                        {{-- {{$p}} --}}
                        <tr>

                            {{-- <td class="col-md-9">{{$p->name}}</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i>{{$p->name}}</td> --}}

         @if ($p->kd_adjusted_quantity == 0)
                                                <td class="col-md-9">{{$p->name}}</td>
                                                 <td class="col-md-3"><i class=""></i>{{ $p->ordered_quantity * $p->price }} Birr</td>
                                                @php
                                                    // $totalSum += $p->ordered_quantity * $p->price;
                                                    $totalSum += $p->ordered_quantity * $p->price;

                                                @endphp
                                            @elseif ($p->kd_adjusted_quantity !== 0)
                                                <td class="col-md-9">{{$p->name}}</td>
                                                <td class="col-md-9">{{ $p->kd_adjusted_quantity * $p->price }} Birr </td>
                                                @php
                                                    // $totalSum += $p->delivered_quantity * $p->price;
                                                    $totalSum += $p->kd_adjusted_quantity * $p->price;

                                                    // $totalSum += $p->kd_adjusted_quantity * $p->price;
                                                @endphp
                                            @endif



                        </tr>

                    @endforeach


                        <tr>

                            <td class="text-right"><h4><strong>Total</strong></h4></td>
                            <td class="text-left text-primary"><h6><strong><i class="">{{ $totalSum }} Birr</i> </strong></h6></td>
                        </tr>

                    </tbody>
                </table>
            </div>

			<div class="row">
				<div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">

							{{-- <h5 style="color: rgb(140, 140, 140);">Thank you for your business!</h5> --}}
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
							{{-- <h1>Signature</h1> --}}
						</div>
					</div>
				</div>
            </div>

        </div>
	</div>
</div>
</div>
</div>
@endsection

