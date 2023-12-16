<div id="layoutSidenav_nav">
<nav class="sb-sidenav accordion sb-sidenav-white color-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu color-dark">
        <div class="nav">
            <div class="sb-sidenav-menu-heading text-dark"></div>
            <a class="nav-link" href="/adminDashboard">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                {{__('messages.Dashboard')}}
            </a>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fa fa-male"></i></div>
             {{__('messages.Clients')}}
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/admin/create/clients">{{__('messages.AddClients')}}</a>
                    <a class="nav-link" href="/admin/view/clients">{{__('messages.ViewClients')}}</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
            {{__('messages.Users')}}
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link" href="/admin/create/user">{{__('messages.AddUsers')}}</a>
                    <a class="nav-link" href="/user/list">{{__('messages.ViewUsers')}}</a>
                </nav>
            </div>


               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Reports" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
              {{ __('messages.Orders')}}
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="Reports" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link" href="/todays/orders">{{ __('messages.TodaysOrders') }}</a>
                <a class="nav-link" href="/admin/order/history">{{ __('messages.OrderHistory') }}</a>
                <a class="nav-link" href="/admin/undelivered/orders">{{ __('messages.UndeliveredOrders') }}</a>
                </nav>
            </div>

           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#product" aria-expanded="false" aria-controls="collapseLayouts">
           <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i> </div>
                {{ __('messages.Products') }}
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="product" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="/admin/add/product">{{ __('messages.AddProducts') }}</a>
                      <a class="nav-link" href="/admin/view/product">{{ __('messages.ViewProducts') }}</a>

                 </nav>
            </div>




            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#category" aria-expanded="false" aria-controls="collapseLayouts">
           <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                {{ __('messages.Catagories') }}
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="category" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href={{url('admin/add/catagory')}}>{{ __('messages.AddCatagories') }}</a>
                      <a class="nav-link" href="/admin/view/catagory">{{ __('messages.ViewCatagories') }}</a>

                 </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#productType" aria-expanded="false" aria-controls="collapseLayouts">
           <div class="sb-nav-link-icon"><i class="fa fa-th"></i></div>
                {{ __('messages.ProductTypes') }}
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="productType" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="/admin/add/ProductType">{{ __('messages.AddProductTypes') }}</a>
                      <a class="nav-link" href="/admin/view/ProductType">{{ __('messages.ViewProductTypes') }}</a>

                 </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#report" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-paste"></i></div>
          {{__('messages.Report')}}
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>


            <div class="collapse" id="report" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link" href="/admin/payment/report">Payment Report</a>
                <a class="nav-link" href="/admin/lastMile/report">Last Mile Delivery Report</a>
                {{-- <a class="nav-link" href="/admin/OrderConfirmation/report">KD Order Conformation Report</a> --}}
            </nav>
            </div>

            <a class="nav-link" href="/admin/Order_hierarchy">
                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                {{__('messages.HandoverHierarchy')}}
            </a>


        </div>
    </div>
</nav>
</div>
