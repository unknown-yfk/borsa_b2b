      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav  position-fixed">
          <li class="nav-item">
            <a class="nav-link" href="/client_dash">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">{{__('messages.Dashboard')}}</span>
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
                <li class="nav-item"> <a class="nav-link" href="/client/show">{{__('messages.ShowProfile')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/client/update/edit">{{__('messages.UpdateProfile')}}</a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="/client/password/change">{{__('messages.ChangePassword')}}</a></li> --}}

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

                <li class="nav-item"> <a class="nav-link" href="/client/order/place">  {{__('messages.PlaceOrder')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/order/show">  {{__('messages.ShowOrders')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/client/ordertracking"> {{__('Order Tracking')}}</a></li>

              </ul>
            </div>
          </li>

                  <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-calendar-range menu-icon"></i>
              <span class="menu-title">Deliveries</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/client/new/deliveries">New Deliveries</a></li>
                <li class="nav-item"> <a class="nav-link"href="/client/delivery/history">Delivery History</a></li>





              </ul>
            </div>
          </li>

        </ul>
      </nav>
