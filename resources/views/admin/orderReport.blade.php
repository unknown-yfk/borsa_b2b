@extends('layouts.mainlayout')
@section('content')
  <style>
        .filter-form {
            display: flex;
            justify-content: end;
            gap: 20px;
            margin: 10px;

        }

        .filter-form button {
            height: 35px;
            margin-top: 25px;
        }
    </style>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <div class="main-panel">
        <div class="content-wrapper">
 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order Report</h4>
                  <p class="card-description">
                  <code>Report</code>
                  </p>
                  <div class="table-responsive pt-3">
                     <form action="{{ '/ho/order/filterorder' }}" method="GET" class="filter-form">
                                <!-- <form action="" method="GET" class="filter-form"> -->

                                <div>
                                    <span>From:</span>
                                    <input type="date" name="from_date" id="from_date" style="width: 160px;"
                                        class="form-control">
                                </div>
                                <div class="">
                                    <label for="to_date">To:</label>
                                    <input type="date" name="to_date" id="to_date" style="width: 160px;"
                                        class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        <table id="table" class="display nowrap" style="width:100%">
                             <thead>
                                      <tr>
                                            <th>Order ID</th>
                                            <th>Last Mile Delivery Status</th>
                                            <th>Order Date</th>
                                            <th>Key Distributor</th>
                                            <th>Client</th>
                                            <th>Sub-Location</th>
                                            <th>City</th>
                                            <th>ROM</th>
                                            <th>ROM Confirmation</th>
                                            <th>ROM Adjusted Confirmation</th>
                                            <th>TM Confirmation</th>
                                            <th>Cico Agent</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                      <tbody>
                                         @if(!empty($LastMileReport) && $LastMileReport->count())
                                      @foreach($LastMileReport as $order)

                                      <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->deliveryStatus}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{Helper::get_kd_name($order->KD_id)}}</td>
                                            <td>{{Helper::get_client_name($order->client_id)}}</td>
                                            <td>{{$order->City}}</td>
                                            <td>{{$order->Region}}</td>
                                            <td>{{Helper::get_rom_name($order->rom_id)}}</td>

                                            @if($order->rom_order_confirmation=="confirmed" && $order->tm_confirmation=="confirmed")

                                                  <td>Confirmed</td>
                                            @elseif($order->rom_order_confirmation=="unconfirmed"  && $order->tm_confirmation=="unconfirmed")
                                            <td>Pending For ROM Confirmation</td>
                                            @else
                                            <td>{{$order->rom_order_confirmation}}</td>
                                            @endif

                                            <td>{{$order->rom_adjusted_confirmation}}</td>

                                            <td>{{$order->tm_confirmation}}</td>

                                            <td>{{Helper::get_agent_name($order->agent_id)}}</td>
                                            <td><form action="{{ ('/ho/order/detailsreport') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$order->id}}" name="order_id" >
                                             <button type="submit" class="btn btn-outline-success">View Details</button>
                                              </form></td>
                                        </tr>
                                @endforeach
                                          @else
                                          <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
                                    </tbody>
                    </table>


                  </div>
                </div>
              </div>
            </div>
        </div>
  </div>
<script>
    $(document).ready(function() {
    $('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>

@endsection
