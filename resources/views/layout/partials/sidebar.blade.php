
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav  position-fixed">
          <li class="nav-item">
            <a class="nav-link" href="/adminDashboard">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">{{__('messages.Dashboard')}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-bas" aria-expanded="false" aria-controls="ui-bas">
              <i class="mdi mdi-human menu-icon"></i>
              <span class="menu-title">{{__('messages.Clients')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-bas">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin/create/clients">{{__('messages.AddClients')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/view/clients">{{__('messages.ViewClients')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/create/tm">{{__('Add TM')}}</a></li>
              </ul>
            </div>
          </li>




           <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basi" aria-expanded="false" aria-controls="ui-basi">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">{{__('messages.Users')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basi">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin/create/user">{{__('messages.AddUsers')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/user/list">{{__('messages.ViewUsers')}}</a></li>
              </ul>
            </div>
          </li>

           <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-cart menu-icon"></i>
              <span class="menu-title">{{__('messages.Orders')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/todays/orders">{{__('messages.TodaysOrders') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/order/history">{{__('messages.OrderHistory') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/undelivered/orders">{{__('messages.UndeliveredOrders') }}</a></li>

              </ul>
            </div>
          </li>


<li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basiccc" aria-expanded="false" aria-controls="ui-basiccc">
              <i class="mdi mdi-briefcase menu-icon"></i>
              <span class="menu-title">{{__('messages.Products') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basiccc">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin/add/product">{{__('messages.AddProducts') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/view/product">{{__('messages.ViewProducts') }}</a></li>
  <li class="nav-item"> <a class="nav-link" href="/admin/add/productlist">{{__('messages.AddProductsList') }}</a></li>
  <li class="nav-item"> <a class="nav-link" href="/admin/view/productlist">{{__('messages.ViewProductsList') }}</a></li>

              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-Catagories" aria-expanded="false" aria-controls="ui-Catagories">
              <i class="mdi mdi-layers menu-icon"></i>
              <span class="menu-title">{{__('messages.Catagories') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Catagories">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin/add/catagory">{{__('messages.AddCatagories') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/view/catagory">{{__('messages.ViewCatagories') }}</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-ProductTypes" aria-expanded="false" aria-controls="ui-ProductTypes">
              <i class="mdi mdi-apps menu-icon"></i>
              <span class="menu-title">{{__('messages.ProductTypes') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-ProductTypes">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin/add/ProductType">{{ ('Add Product Types') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/view/ProductType">{{ ('View Product Types') }}</a></li>
              </ul>
            </div>
          </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-Report" aria-expanded="false" aria-controls="ui-Report">
              <i class="mdi mdi-book-multiple menu-icon"></i>
              <span class="menu-title">{{__('messages.Report') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Report">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin/payment/report">{{ ('Payment Report') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/lastMile/report">{{ ('Last Mile Delivery Report') }}</a></li>
              </ul>
            </div>
          </li>





          <li class="nav-item">
            <a class="nav-link" href="/admin/Order_hierarchy">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">{{__('messages.HandoverHierarchy')}}</span>
            </a>
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
