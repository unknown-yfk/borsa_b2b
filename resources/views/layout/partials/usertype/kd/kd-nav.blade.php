   <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
       <div class="navbar-brand-wrapper d-flex justify-content-center">
           <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
               {{-- <a class="navbar-brand brand-logo text-light" href="index.html"><h2>Borsa</h2></a> --}}
               <a class="navbar-brand brand-logo"
                   @if (auth()->user()->key_distro == null) {href="/home"} @else {href="/key_distroDashboard"} @endif><img
                       src="{!! asset('that/images/Borsa.png" alt="logo') !!}" height="40" width="105"></a>
               <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                   <span class="mdi mdi-sort-variant"></span>
               </button>
           </div>
       </div>
       <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

           <ul class="navbar-nav navbar-nav-right">

               <li class="nav-item nav-profile dropdown">
                   <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                       <img src="../../assets/user_img/{{ Auth::user()->userPhoto }}"
                           alt="{{ Auth::user()->userName }}">
                       <span class="nav-profile-name">{{ Auth::user()->firstName }}
                           {{ Auth::user()->middleName }}</span>
                   </a>
                   <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                       <a class="dropdown-item">
                           <i class="mdi mdi-settings text-primary"></i>
                           Settings
                       </a>
                       <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                           <i class="mdi mdi-logout text-primary"></i>
                           Logout
                       </a>
                       {{ LogActivity::addToLog('Logout') }}


                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                       </form>
                   </div>
               </li>
           </ul>
           <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
               data-toggle="offcanvas">
               <span class="mdi mdi-menu"></span>
           </button>
       </div>
   </nav>
