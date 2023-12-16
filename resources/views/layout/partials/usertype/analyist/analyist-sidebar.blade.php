<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav  position-fixed">
        <li class="nav-item">
            <a class="nav-link" href="/analyistDashboard">
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
                            href="/analyist/view/clients">{{ __('messages.ViewClients') }}</a></li>

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
                    <li class="nav-item"> <a class="nav-link" href="/analyist/user/list">{{ __('messages.ViewUsers') }}</a></li>
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
                            href="/analyist/onboarding/report">Target profile & <br>
                             oboarding report</a></li>
                </ul>
            </div>


        </li>
    </ul>
</nav>
