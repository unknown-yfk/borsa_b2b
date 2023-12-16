      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav  position-fixed">
               @if (auth()->user()->agent == Null)
          <li class="nav-item">
            <a class="nav-link" href="/agentDashboard">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">{{__('messages.Dashboard')}}</span>
            </a>
          </li>

          @else
            <li class="nav-item">
            <a class="nav-link" href="/agentDashboard">
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
                <li class="nav-item"> <a class="nav-link" href="/agentProfile/show">{{__('messages.ShowProfile')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/agent/update/edit">{{__('messages.UpdateProfile')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/agent/password/change">{{__('messages.ChangePassword')}}</a></li>

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

                <li class="nav-item"> <a class="nav-link" href="/filter_client_id">  {{__('messages.PlaceOrder')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/order/show">  {{__('messages.ShowOrders')}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="/ordertracking">  {{__('Order Tracking')}}</a></li>


              </ul>
            </div>
          </li>
          @endif

        </ul>
      </nav>
