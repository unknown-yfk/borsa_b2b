<style>
    #sidebar {
        width: 260px;
    }
</style>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/adminDashboard">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">{{ __('messages.Dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-bas" aria-expanded="false" aria-controls="ui-bas">
                <i class="mdi mdi-human menu-icon"></i>
                <span class="menu-title">{{ __('messages.Clients') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-bas">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/create/clients">{{ __('messages.AddClients') }}</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/view/clients">{{ __('messages.ViewClients') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/create/tm">{{ __('Add TM') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/create/facilator">ADD Facilitator</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basi" aria-expanded="false" aria-controls="ui-basi">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">{{ __('messages.Users') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basi">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/create/user">{{ __('messages.AddUsers') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/user/list">{{ __('messages.ViewUsers') }}</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="mdi mdi-cart menu-icon"></i>
                <span class="menu-title">{{ __('messages.Orders') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="/todays/orders">{{ __('messages.TodaysOrders') }}</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/order/history">{{ __('messages.OrderHistory') }}</a></li>

                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/undelivered/orders">{{ __('messages.UndeliveredOrders') }}</a></li>


                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basiccc" aria-expanded="false"
                aria-controls="ui-basiccc">
                <i class="mdi mdi-briefcase menu-icon"></i>
                <span class="menu-title">{{ __('messages.Products') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basiccc">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/add/product">{{ __('messages.AddProducts') }}</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/view/product">{{ __('messages.ViewProducts') }}</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/add/productlist">{{ __('messages.AddProductsList') }}</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/view/productlist">{{ __('messages.ViewProductsList') }}</a></li>

                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-Catagories" aria-expanded="false"
                aria-controls="ui-Catagories">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">{{ __('messages.Catagories') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Catagories">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/add/catagory">{{ __('messages.AddCatagories') }}</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/view/catagory">{{ __('messages.ViewCatagories') }}</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-ProductTypes" aria-expanded="false"
                aria-controls="ui-ProductTypes">
                <i class="mdi mdi-apps menu-icon"></i>
                <span class="menu-title">{{ __('messages.ProductTypes') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-ProductTypes">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/add/ProductType">{{ 'Add Product Types' }}</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/view/ProductType">{{ 'View Product Types' }}</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-region" aria-expanded="false"
                aria-controls="ui-region">
                <i class="mdi mdi-map menu-icon"></i>
                <span class="menu-title">Region</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-region">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/add/Region">Add Region </a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/view/Region">View Region</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-city" aria-expanded="false"
                aria-controls="ui-city">
                <i class="mdi mdi-city menu-icon"></i>
                <span class="menu-title">City</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-city">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/add/City">Add City</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/view/City">View City</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-Report" aria-expanded="false"
                aria-controls="ui-Report">
                <i class="mdi mdi-book-multiple menu-icon"></i>
                <span class="menu-title">{{ __('messages.Report') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Report">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="/admin/payment/report">{{ 'Payment Report' }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/orderstatus/report">Order Status
                            Report</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/order/report">{{ 'Order Report' }}</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="/ho/lastMile/report">{{ 'Last Mile Delivery Report' }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/product/report">Product Report</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/productperagent/report">Product Report Per
                            Agent</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/productperloaction/report">Product Report<br>
                            Per Location</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/productpersubloaction/report">Product Report
                            <br> Per Sub-Location</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/onboarding/report">Target profile & <br>
                            oboarding report</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/orderfulfilment/report">Order Fulfilment
                            Report</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/ordercapture/report">Order Capture Summary
                            <br> Report</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/ordercapturetransaction/report">Order Capture
                            Transaction <br> Summary Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/orderfulfilment/report1">Order Fulfilment
                            <br> Summary Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/orderfulfilmenttransaction/report">Order
                            Fulfilment Transaction <br> Summary Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/loan/report">
                            Loan Report</a></li>




                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/Order_hierarchy">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">{{ __('messages.HandoverHierarchy') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/order/Status">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span>Order Status</span>
            </a>
        </li>

    </ul>
</nav>
