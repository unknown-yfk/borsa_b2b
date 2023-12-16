@include('layout.header')
<body class="sb-nav-fixed">
    @include('sweetalert::alert')
   @include('nav.agent_navbar')
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="/agentDashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                               Profile
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/agentProfile/show">show profile</a>
                                    <a class="nav-link" href="/agent/update/edit">update profile</a>

                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#"  aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              clients

                            </a>




                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                              orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                      New Orders
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>

                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                     delivered Orders
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>

                                </nav>
                            </div>

                        </div>
                    </div>

                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Client List</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>

                            </div>
                            <div class="card-body">

                            <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>

                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Client ID</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                          <th>Business Name</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($client as $client)
                                      <tr>
                                            <td>{{$client->id}}</td>
                                            <td>{{$client->firstName}} {{$client->middleName}} {{$client->lastName}}</td>
                                            <td>{{$client->client_address}}</td>
                                            <td>{{$client->client_businessName}}</td>

                                        </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                </main>
               @include('layout.footer')
            </div>
        </div>
   </body>
</html>
