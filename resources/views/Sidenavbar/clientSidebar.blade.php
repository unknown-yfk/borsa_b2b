<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
       <div class="sb-sidenav-menu">
           <div class="nav">
               <div class="sb-sidenav-menu-heading"></div>
               <a class="nav-link" href="/client_dash">
                   <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                   Dashboard
               </a>
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                   <div class="sb-nav-link-icon"><i class="far fa-user-circle"></i></div>
                  Profile
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
               </a>
               <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                   <nav class="sb-sidenav-menu-nested nav">
                       <a class="nav-link" href="/client/show">View Profile</a>
                       <a class="nav-link" href="/client/update/edit">Update Profile</a>
                       <a class="nav-link" href="/client/password/change">Change Password</a>
                    </nav>
                </div>


                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-people-carry"></i></div>
                              Deliveries
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/client/new/deliveries">New Deliveries</a>
                             <a class="nav-link" href="/client/delivery/history">Delivery History</a>
                                </nav>
                            </div>


                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                      Orders
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapse" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="/client/order/place">Place Order</a>
                                    <a class="nav-link" href="/order/show">Show Orders</a>
                                </nav>
                            </div>
                          </div>
                    </div>
                </nav>
            </div>
