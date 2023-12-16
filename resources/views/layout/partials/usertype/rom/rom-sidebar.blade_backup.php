      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav  position-fixed">
          <li class="nav-item">
            <a class="nav-link" href="/romDashboard">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">{{__('messages.Dashboard')}}</span>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-bas" aria-expanded="false" aria-controls="ui-bas">
              <i class="mdi mdi-human menu-icon"></i>
              <span class="menu-title">{{__('messages.Profile')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-bas">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin/create/clients">{{__('messages.AddClients')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/view/clients">{{__('messages.ViewClients')}}</a></li>
              </ul>
            </div>
          </li> --}}

           <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basi" aria-expanded="false" aria-controls="ui-basi">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">{{__('messages.Profile')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basi">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/romProfile/show">Show Profile</a></li>
                <li class="nav-item"> <a class="nav-link" href="/rom/update/edit">Update Profile</a></li>
                <li class="nav-item"> <a class="nav-link" href="/rom/password/change">Change Password</a></li>

              </ul>
            </div>
          </li>

              <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-o" aria-expanded="false" aria-controls="ui-o">
              <i class="mdi mdi-calendar-range menu-icon"></i>
              <span class="menu-title">{{ __('messages.Orders')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-o">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/rom/orders/show">New Orders</a></li>
                <li class="nav-item"> <a class="nav-link" href="/rom/orders/history">Orders History</a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="rom/order/history">Confirmed Orders<br>(to be handovered)</a></li> --}}
                {{-- <li class="nav-item"> <a class="nav-link" href="/order/pending">Pending Orders<br>(needs reassurance)</a></li> --}}



              </ul>
            </div>
          </li>

           <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basiccc" aria-expanded="false" aria-controls="ui-basiccc">
                  <i class="mdi mdi-briefcase menu-icon"></i>
                  <span class="menu-title">{{ __('messages.Products') }}</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basiccc">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="/rom/add/product">{{ __('messages.AddProducts') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/rom/view/product">{{ __('messages.ViewProducts') }}</a></li>
                  </ul>
                </div>
              </li>

           <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-calendar-range menu-icon"></i>
              <span class="menu-title">{{__('messages.Deliveries')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/new/deliveries">New Deliveries</a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="/filter/clients">New Deliveries</a></li> --}}


                <li class="nav-item"> <a class="nav-link" href="/delivery_search">Confirmed Deliveries <br>To be Handovered</a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="/handover2/history">Handovers</a></li>

                <li class="nav-item"> <a class="nav-link" href="/romUndeliveredOrders">Undelivered Orders</a></li> --}}


              </ul>
            </div>
          </li>




        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-Report" aria-expanded="false" aria-controls="ui-Report">
              <i class="mdi mdi-book-multiple menu-icon"></i>
              <span class="menu-title">{{ __('messages.Report') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Report">
              <ul class="nav flex-column sub-menu">
                {{-- <li class="nav-item"> <a class="nav-link" href="/rom/report/handover/accepted">Handover Report</a></li> --}}
                <li class="nav-item"> <a class="nav-link"  href="/rom/report/handover/delivered">Delivery Report</a></li>
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
