@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="d-flex align-items-end flex-wrap">
                            <div class="me-md-3 me-xl-5">
                                <h2>{{ Auth::user()->firstName }} {{ Auth::user()->middleName }}</h2>
                                <p class="mb-md-0">dashboard </p>

                                @if (auth()->user()->key_distro == null)
                                    <div class="card-body border-top">
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Well done!</h4>
                                            <p></p>
                                            <hr />
                                            <p class="mb-0">
                                                Please Complete Your Profile Set-Up to Use the system!<a
                                                    href="/key_distro/create/post">Click here</a></p>
                                        </div>
                                @endif
                            </div>
                            <div class="d-flex">
                                <i class="mdi mdi-home text-muted hover-cursor"></i>
                                <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                                {{-- <p class="text-primary mb-0 hover-cursor">Analytics</p> --}}
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end flex-wrap">
                            {{-- <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
                                <i class="mdi mdi-download text-muted"></i>
                            </button>
                            <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                                <i class="mdi mdi-clock-outline text-muted"></i>
                            </button>
                            <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                                <i class="mdi mdi-plus text-muted"></i>
                            </button>
                            <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button> --}}
                        </div>
                    </div>
                </div>
            </div>
            @if (auth()->user()->key_distro !== null && auth()->user()->key_distro->has_tm == 0)
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body dashboard-tabs p-0">
                                <ul class="nav nav-tabs px-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview"
                                            role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                    <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab"
                                        aria-controls="sales" aria-selected="false">Unconfirmed orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases"
                                        role="tab" aria-controls="purchases" aria-selected="false">Confirmed Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="users-tab" data-bs-toggle="tab" href="#users" role="tab"
                                        aria-controls="users" aria-selected="false">To date</a>
                                </li> --}}

                                </ul>

                                <div class="tab-content py-0 px-0">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                        aria-labelledby="overview-tab">
                                        <div class="d-flex flex-wrap justify-content-xl-between">
                                            <div
                                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Start date</small>
                                                    <div class="dropdown">
                                                        {{-- <input type="date"> --}}
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                            {{-- <input type="date"> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="text-decoration-none" href="/orders/show">
                                                <div
                                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i class="mdi mdi-clipboard-alert me-3 icon-lg text-danger"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted">Unconfirmed Orders</small>
                                                        <h5 class="me-2 mb-0">{{ $unconfirmed }}</h5>
                                                    </div>

                                                </div>
                                            </a>
                                            <a class="text-decoration-none" href="/order/history">
                                                <div
                                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i
                                                        class="mdi mdi-checkbox-multiple-marked me-3 icon-lg text-success"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted">Confirmed Orders</small>
                                                        <h5 class="me-2 mb-0">{{ $confirmed }}</h5>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="text-decoration-none" href="/handover/history">
                                                <div
                                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i class="mdi mdi-cart me-3 icon-lg text-danger"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted">Delivered Orders</small>
                                                        <h5 class="me-2 mb-0">{{ $deliveredOrders }}</h5>
                                                    </div>
                                                </div>
                                            </a>
                                            {{-- <a class="text-decoration-none" href="/order/returned">
                                                <div
                                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i class="mdi mdi-keyboard-return me-3 icon-lg text-danger"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted">Returned Orders</small>
                                                        <h5 class="me-2 mb-0">{{ $returnedcount }}</h5>
                                                    </div>
                                                </div>
                                            </a> --}}




                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                                        <div class="d-flex flex-wrap justify-content-xl-between">
                                            <div
                                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Start date</small>
                                                    <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                            href="#" role="button" id="dropdownMenuLinkA"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                            <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                            <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                            <a class="dropdown-item" href="#">21 Oct 2018</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Downloads</small>
                                                    <h5 class="me-2 mb-0">2233783</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total views</small>
                                                    <h5 class="me-2 mb-0">9833550</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Revenue</small>
                                                    <h5 class="me-2 mb-0">$577545</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Flagged</small>
                                                    <h5 class="me-2 mb-0">3497843</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="purchases" role="tabpanel"
                                        aria-labelledby="purchases-tab">
                                        <div class="d-flex flex-wrap justify-content-xl-between">
                                            <div
                                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Start date</small>
                                                    <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                            href="#" role="button" id="dropdownMenuLinkA"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                            <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                            <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                            <a class="dropdown-item" href="#">21 Oct 2018</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Revenue</small>
                                                    <h5 class="me-2 mb-0">$577545</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total views</small>
                                                    <h5 class="me-2 mb-0">9833550</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Downloads</small>
                                                    <h5 class="me-2 mb-0">2233783</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Flagged</small>
                                                    <h5 class="me-2 mb-0">3497843</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="users" role="tabpanel"
                                        aria-labelledby="users-tab">
                                        <div class="d-flex flex-wrap justify-content-xl-between">
                                            <div
                                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Start date</small>
                                                    <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                            href="#" role="button" id="dropdownMenuLinkA"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                            <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                            <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                            <a class="dropdown-item" href="#">21 Oct 2018</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Clients</small>
                                                    {{-- <h5 class="me-2 mb-0">{{$client}}</h5> --}}
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total Users</small>
                                                    {{-- <h5 class="me-2 mb-0">{{$users}}</h5> --}}
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total agents</small>
                                                    {{-- <h5 class="me-2 mb-0">{{$agents}}</h5> --}}
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Key distributors</small>
                                                    {{-- <h5 class="me-2 mb-0">{{$kds}}</h5> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    {{-- <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Cash deposits</p>
                            <p class="mb-4">To start a blog, think of a topic about and first brainstorm party is ways to
                                write details</p>
                            <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                            <canvas id="cash-deposits-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Total sales</p>
                            1122 Birr
                            <h4>Gross sales since 2013</h4>
                            <p class="text-muted">Today, many people rely on computers to do homework, work, and create or
                                store useful information. Therefore, it is important </p>
                            <div id="total-sales-chart-legend"></div>
                        </div>
                        <canvas id="total-sales-chart"></canvas>
                    </div>
                </div> --}}
                </div>
                <div class="row">
                    <div class="col-md-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Recent Purchases</p>
                                <div class="table-responsive">
                                    <table id="recent-purchases-listing" class="table">
                                        <thead>

                                            <tr>
                                                <th>Order ID</th>
                                                <th>Client</th>
                                                <th>Order Date</th>
                                                <th>Confirmation Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($client as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->firstName }} {{ $order->middleName }}
                                                        {{ $order->lastName }}</td>
                                                    <td>{{ $order->createdDate }}</td>
                                                    <td>{{ $order->confirmStatus }}</td>
                                                    <td>
                                                        <form action="{{ '/kd_unconfirmed_details' }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{ $order->id }}"
                                                                name="order_id">
                                                            <button type="submit" class="btn btn-outline-success">View
                                                                details</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->key_distro !== null && auth()->user()->key_distro->has_tm == 1)
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body dashboard-tabs p-0">
                                <ul class="nav nav-tabs px-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                            href="#overview" role="tab" aria-controls="overview"
                                            aria-selected="true">Overview</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                    <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab"
                                        aria-controls="sales" aria-selected="false">Unconfirmed orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases"
                                        role="tab" aria-controls="purchases" aria-selected="false">Confirmed Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="users-tab" data-bs-toggle="tab" href="#users" role="tab"
                                        aria-controls="users" aria-selected="false">To date</a>
                                </li> --}}

                                </ul>

                                <div class="tab-content py-0 px-0">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                        aria-labelledby="overview-tab">
                                        <div class="d-flex flex-wrap justify-content-xl-between">
                                            <div
                                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Start date</small>
                                                    <div class="dropdown">
                                                        {{-- <input type="date"> --}}
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                            {{-- <input type="date"> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                                <div
                                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i class="mdi mdi-clipboard-alert me-3 icon-lg text-danger"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted">Unconfirmed Orders</small>
                                                        <h5 class="me-2 mb-0">{{ $unconfirmed }}</h5>
                                                    </div>

                                                </div>


                                                <div
                                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i
                                                        class="mdi mdi-checkbox-multiple-marked me-3 icon-lg text-success"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted">Confirmed Orders</small>
                                                        <h5 class="me-2 mb-0">{{ $confirmed }}</h5>
                                                    </div>
                                                </div>


                                                <div
                                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i class="mdi mdi-cart me-3 icon-lg text-danger"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted">Delivered Orders</small>
                                                        <h5 class="me-2 mb-0">{{ $deliveredOrders }}</h5>
                                                    </div>
                                                </div>


                                                {{-- <div
                                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                    <i class="mdi mdi-keyboard-return me-3 icon-lg text-danger"></i>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <small class="mb-1 text-muted">Returned Orders</small>
                                                        <h5 class="me-2 mb-0">{{ $returnedcount }}</h5>
                                                    </div>
                                                </div> --}}





                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="sales" role="tabpanel"
                                        aria-labelledby="sales-tab">
                                        <div class="d-flex flex-wrap justify-content-xl-between">
                                            <div
                                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Start date</small>
                                                    <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                            href="#" role="button" id="dropdownMenuLinkA"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                            <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                            <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                            <a class="dropdown-item" href="#">21 Oct 2018</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Downloads</small>
                                                    <h5 class="me-2 mb-0">2233783</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total views</small>
                                                    <h5 class="me-2 mb-0">9833550</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Revenue</small>
                                                    <h5 class="me-2 mb-0">$577545</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Flagged</small>
                                                    <h5 class="me-2 mb-0">3497843</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="purchases" role="tabpanel"
                                        aria-labelledby="purchases-tab">
                                        <div class="d-flex flex-wrap justify-content-xl-between">
                                            <div
                                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Start date</small>
                                                    <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                            href="#" role="button" id="dropdownMenuLinkA"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                            <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                            <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                            <a class="dropdown-item" href="#">21 Oct 2018</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Revenue</small>
                                                    <h5 class="me-2 mb-0">$577545</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total views</small>
                                                    <h5 class="me-2 mb-0">9833550</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Downloads</small>
                                                    <h5 class="me-2 mb-0">2233783</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Flagged</small>
                                                    <h5 class="me-2 mb-0">3497843</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="users" role="tabpanel"
                                        aria-labelledby="users-tab">
                                        <div class="d-flex flex-wrap justify-content-xl-between">
                                            <div
                                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Start date</small>
                                                    <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                            href="#" role="button" id="dropdownMenuLinkA"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                            <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                            <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                            <a class="dropdown-item" href="#">21 Oct 2018</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Clients</small>
                                                    {{-- <h5 class="me-2 mb-0">{{$client}}</h5> --}}
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total Users</small>
                                                    {{-- <h5 class="me-2 mb-0">{{$users}}</h5> --}}
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total agents</small>
                                                    {{-- <h5 class="me-2 mb-0">{{$agents}}</h5> --}}
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Key distributors</small>
                                                    {{-- <h5 class="me-2 mb-0">{{$kds}}</h5> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    {{-- <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Cash deposits</p>
                            <p class="mb-4">To start a blog, think of a topic about and first brainstorm party is ways to
                                write details</p>
                            <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                            <canvas id="cash-deposits-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Total sales</p>
                            1122 Birr
                            <h4>Gross sales since 2013</h4>
                            <p class="text-muted">Today, many people rely on computers to do homework, work, and create or
                                store useful information. Therefore, it is important </p>
                            <div id="total-sales-chart-legend"></div>
                        </div>
                        <canvas id="total-sales-chart"></canvas>
                    </div>
                </div> --}}
                </div>
                <div class="row">
                    <div class="col-md-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Recent Purchases</p>
                                <div class="table-responsive">
                                    <table id="recent-purchases-listing" class="table">
                                        <thead>

                                            <tr>
                                                <th>Order ID</th>
                                                <th>Client</th>
                                                <th>Order Date</th>
                                                <th>Confirmation Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($client as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->firstName }} {{ $order->middleName }}
                                                        {{ $order->lastName }}</td>
                                                    <td>{{ $order->createdDate }}</td>
                                                    <td>{{ $order->confirmStatus }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  @endif
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright � Elebat solution<a
                        href="https://Elebatsolution.com/" target="_blank">Elebatsolution.com </a>2023</span>

            </div>
        </footer>
        <!-- partial -->
    </div>
@endsection
