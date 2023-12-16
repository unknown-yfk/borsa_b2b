<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="background-color: #00008B !important" >
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/adminDashboard"> {{ Auth::user()->firstName }} {{ Auth::user()->middleName }}</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

            </form>
            <!-- Navbar-->
            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <ul class="navbar-nav float-end ">
                          <!-- ============================================================== -->
                          <!-- Comment -->
                          <!-- ============================================================== -->




                          </li>
                          <!-- ============================================================== -->
                          <!-- End Comment -->
                          <!-- ============================================================== -->


                          <!-- ============================================================== -->
                          <!-- User profile and search -->
                          <!-- ============================================================== -->
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                                  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                  aria-expanded="false">
                                  <img src="../../assets/img/{{Auth::user()->userPhoto}}" alt="{{ Auth::user()->userName }}"
                                      class="rounded-circle" width="50" height="50" />
                              </a>
                              <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                  aria-labelledby="navbarDropdown">
                                  <div class="ps-4 p-10">
                                      <li>
                                          <form action="{{ route('logout') }}" method="post">
                                              @csrf
                                              <input class="btn btn-sm btn-success btn-rounded text-white" type="submit"
                                                  value="Logout">
                                          </form>
                                      </li>
                                  </div>
                              </ul>
                          </li>
                          <!-- ============================================================== -->
                          <!-- User profile and search -->
                          <!-- ============================================================== -->
                      </ul>

                        @endguest
        </nav>
