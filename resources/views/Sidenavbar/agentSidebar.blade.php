<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
       <div class="sb-sidenav-menu">
           <div class="nav">
               <div class="sb-sidenav-menu-heading"></div>
               <a class="nav-link" href="/agentDashboard">
                   <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                     {{__('messages.Dashboard')}}
               </a>
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                   <div class="sb-nav-link-icon"><i class="far fa-user-circle"></i></div>
                  {{__('messages.Profile')}}
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
               </a>
               <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                   <nav class="sb-sidenav-menu-nested nav">
                       <a class="nav-link" href="/agentProfile/show">{{__('messages.ShowProfile')}}</a>
                       <a class="nav-link" href="/agent/update/edit">{{__('messages.UpdateProfile')}}</a>
                       <a class="nav-link" href="/agent/password/change">{{__('messages.ChangePassword')}}</a>
                    </nav>
                </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                        {{__('messages.Orders')}}
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="/order/place">  {{__('messages.PlaceOrder')}}</a>
                                    <a class="nav-link" href="/order/show">  {{__('messages.ShowOrders')}}</a>
                                </nav>
                            </div>
                          </div>
                    </div>
                </nav>
            </div>
