@extends('layouts.mainlayout')
@section('content')

    <div class="main-panel">
        <div class="content-wrapper">




            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order History</h4>

                        <p class="card-description">
                            <code>List of Orders</code>
                        </p>
                        <input id="myInput" type="text" placeholder="Search orders here..">
                        <div class="table-responsive pt-3">
                            {{-- <table id="datatable" class="table"> --}}
                            <table id="recent-purchases-listing" class="table">

                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Client</th>
                                        <th>Region</th>
                                        <th>City</th>
                                        <th>Order Date</th>
                                        <th>Payment Status</th>
                                        <th>Confirmation Status</th>
                                        <th>Delivery Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @if (!empty($client) && $client->count())
                                        @foreach ($client as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->firstName }} {{ $order->middleName }} {{ $order->lastName }}
                                                </td>
                                                <td>{{ $order->Region }}</td>
                                                <td>{{ $order->City }}</td>
                                                <td>{{ $order->createdDate }}</td>
                                                <td>{{ $order->paymentStatus }}</td>
                                                <td>{{ $order->confirmStatus }}</td>
                                                <td>{{ $order->deliveryStatus }}</td>
                                                <td>
                                                    <form action="{{ '/tm_confirmed_details' }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $order->id }}" name="order_id">
                                                        <button type="submit" class="btn btn-outline-success">View
                                                            Details</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{-- {!! $client->links() !!} --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>


@endsection
