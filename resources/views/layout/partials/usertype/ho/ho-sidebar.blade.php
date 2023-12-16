<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav  position-fixed">
        <li class="nav-item">
            <a class="nav-link" href="/hoDashboard">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">{{ __('messages.Dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basi" aria-expanded="false" aria-controls="ui-basi">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">{{__('messages.Profile')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basi">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/ho/password/change">Change Password</a></li>
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
                    <li class="nav-item"> <a class="nav-link" href="/ho/order/report">{{ 'Order Report' }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/ho/lastMile/report">{{ 'Last Mile Delivery Report' }}</a></li>
                     <li class="nav-item"> <a class="nav-link" href="/ho/product/report">Product Report</a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/ho/productperagent/report">Product Report Per Agent</a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/ho/productperloaction/report">Product Report<br> Per Location</a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/ho/productpersubloaction/report">Product Report <br> Per  Sub-Location</a></li>
                     <li class="nav-item"> <a class="nav-link" href="/ho/onboarding/report">Target profile & <br> oboarding report</a></li>
                     <li class="nav-item"> <a class="nav-link"  href="/ho/orderfulfilment/report">Order Fulfilment Report</a></li>
                                     </ul>
            </div>
        </li>







        {{-- <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Icons</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> --}}
    </ul>
</nav>
