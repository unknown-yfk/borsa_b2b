<style>
#sidebar
{
    width: 260px;
}
</style>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/accionDashboard">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">{{ __('messages.Dashboard') }}</span>
            </a>
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
                    <li class="nav-item"> <a class="nav-link" href="/accion/order/report">{{ 'Order Report' }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/accion/lastMile/report">{{ 'Last Mile Delivery Report' }}</a></li>
                     <li class="nav-item"> <a class="nav-link" href="/accion/product/report">Product Report</a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/accion/productperagent/report">Product Report Per Agent</a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/accion/productperloaction/report">Product Report<br> Per Location</a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/accion/productpersubloaction/report">Product Report <br> Per  Sub-Location</a></li>
                     <li class="nav-item"> <a class="nav-link" href="/accion/target/report">Target profile & <br> onboarding report</a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/accion/orderfulfilment/report">Order Fulfilment Report</a></li>

                      <li class="nav-item"> <a class="nav-link" href="/accion/ordercapture/report">Order Capture Summary <br> Report</a></li>
                     <li class="nav-item"> <a class="nav-link" href="/accion/ordercapturetransaction/report">Order Capture Transaction <br> Summary Report </a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/accion/orderfulfilment/report1">Order Fulfilment <br> Summary Report</a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/accion/orderfulfilmenttransaction/report">Order Fulfilment Transaction <br> Summary Report </a></li>
                </ul>
            </div>



        </li>
    </ul>
</nav>
