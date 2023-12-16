      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav  position-fixed">



          <li class="nav-item">
            <a class="nav-link" href="/tmDashboard">
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
                <li class="nav-item"> <a class="nav-link" href="/tmProfile/show">Show Profile</a></li>
                <li class="nav-item"> <a class="nav-link" href="/tm/update/edit">Update Profile</a></li>
                <li class="nav-item"> <a class="nav-link" href="/tm/password/change">Change Password</a></li>

              </ul>
            </div>
          </li>

           <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-calendar-range menu-icon"></i>
              <span class="menu-title">{{ __('messages.Orders')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/tm/orders/show">unconfirmed Orders</a></li>
                <li class="nav-item"> <a class="nav-link" href="/tm/order/history">Confirmed Orders<br>(to be handovered)</a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="/order/pending">Pending Orders<br>(needs reassurance)</a></li> --}}



              </ul>
            </div>
          </li>




          {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basiccc" aria-expanded="false" aria-controls="ui-basiccc">
              <i class="mdi mdi-briefcase menu-icon"></i>
              <span class="menu-title">{{ __('messages.Products') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basiccc">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/tm/add/product">{{ __('messages.AddProducts') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/tm/view/product">{{ __('messages.ViewProducts') }}</a></li>
              </ul>
            </div>
          </li> --}}

          {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-Handover" aria-expanded="false" aria-controls="ui-Handover">
              <i class="mdi mdi-layers menu-icon"></i>
              <span class="menu-title">{{ __('messages.Handover') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Handover">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link"  href="/tm/handover/history"> Handovered Orders</a></li> --}}
                {{-- <li class="nav-item"> <a class="nav-link"  href="/tm/undelivered/orders">Undelivered Products</a></li> --}}
              {{-- </ul>
            </div>
          </li> --}}
                <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-Report" aria-expanded="false" aria-controls="ui-Report">
              <i class="mdi mdi-book-multiple menu-icon"></i>
              <span class="menu-title">{{ __('messages.Report') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Report">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/tm/report/order/accepted">Order Report</a></li>
                <li class="nav-item"> <a class="nav-link"  href="/tm/report/handover">Handover Report</a></li>
              </ul>
            </div>
          </li>

          {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-ProductTypes" aria-expanded="false" aria-controls="ui-ProductTypes">
              <i class="mdi mdi-apps menu-icon"></i>
              <span class="menu-title">{{ __('messages.ProductTypes') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-ProductTypes">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin/add/ProductType">{{ __('Add Product Types') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/view/ProductType">{{ __('View Product Types') }}</a></li>
              </ul>
            </div>
          </li> --}}
              {{-- @elseif(auth()->user()->key_distro->has_tm==1) --}}

        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-Report" aria-expanded="false" aria-controls="ui-Report">
              <i class="mdi mdi-book-multiple menu-icon"></i>
              <span class="menu-title">{{ __('messages.Report') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Report">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/tm/report/order/accepted">Order Report</a></li>
                <li class="nav-item"> <a class="nav-link"  href="/tm/report/handover">Handover Report</a></li>
              </ul>
            </div>
          </li> --}}
          {{-- @endif --}}








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
