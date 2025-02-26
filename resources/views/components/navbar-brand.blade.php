<div class="navbar-header">
    <div class="navbar-logo-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/self/recycle 1.png') }}" alt="logo-sm-light" class="rotate"
                    height="30">
            </span>
            <span class="logo-lg">
                <img class="rotate" src="{{ asset('assets/images/self/recycle 1.png') }}" alt="logo-light"
                    height="30">
                <img src="{{ asset('assets/images/self/eco cycle dark mode.png') }}" alt="logo-light" height="70">
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/self/recycle 1.png') }}" alt="logo-sm-light" class="rotate"
                    height="30">
            </span>
            <span class="logo-lg">
                <img class="rotate" src="{{ asset('assets/images/self/recycle 1.png') }}" alt="logo-light"
                    height="30">
                <img src="{{ asset('assets/images/self/eco cycle 1.png') }}" alt="logo-light" height="70">
            </span>
        </a>

        <button type="button" class="btn btn-sm top-icon sidebar-btn" id="sidebar-btn">
            <i class="mdi mdi-menu-open align-middle fs-19"></i>
        </button>
    </div>

    <!-- Start menu -->
    <div class="d-flex justify-content-between menu-sm px-3 ms-auto">

        <div class="d-flex align-items-center gap-2 ms-auto">

            <!-- Start Profile -->
            <div class="dropdown d-inline-block">

                <button type="button" class="btn btn-sm top-icon p-0" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded avatar-2xs p-0" src="{{ asset('assets/images/users/avatar-6.png') }}"
                        alt="Header Avatar">
                </button>
                <div
                    class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0">
                    <div class="card border-0">
                        <div class="card-header bg-primary rounded-0">
                            <div class="rich-list-item w-100 p-0">
                                <div class="rich-list-prepend">
                                    <div class="avatar avatar-label-light avatar-circle">
                                        <div class="avatar-display"><i class="fa fa-user-alt"></i></div>
                                    </div>
                                </div>
                                <div class="rich-list-content">
                                    <h3 class="rich-list-title text-white">{{ auth()->user()->nama }}</h3>
                                    {{-- <span class="rich-list-subtitle text-white">admin@</span> --}}
                                </div>
                                {{-- <div class="rich-list-append"><span class="badge badge-label-light fs-6">6+</span></div> --}}
                            </div>
                        </div>
                        {{-- <div class="card-body p-0">
                            <div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
                                <div class="grid-nav-row">
                                    <a href="apps-contact.html" class="grid-nav-item">
                                        <div class="grid-nav-icon"><i class="far fa-address-card"></i>
                                        </div>
                                        <span class="grid-nav-content">Profile</span>
                                    </a>
                                    <a href="#!" class="grid-nav-item">
                                        <div class="grid-nav-icon"><i class="far fa-comments"></i></div>
                                        <span class="grid-nav-content">Messages</span>
                                    </a>
                                    <a href="#!" class="grid-nav-item">
                                        <div class="grid-nav-icon"><i class="far fa-clone"></i></div>
                                        <span class="grid-nav-content">Activities</span>
                                    </a>
                                </div>
                                <div class="grid-nav-row">
                                    <a href="#!" class="grid-nav-item">
                                        <div class="grid-nav-icon"><i class="far fa-calendar-check"></i>
                                        </div>
                                        <span class="grid-nav-content">Tasks</span>
                                    </a>
                                    <a href="#!" class="grid-nav-item">
                                        <div class="grid-nav-icon"><i class="far fa-sticky-note"></i>
                                        </div>
                                        <span class="grid-nav-content">Notes</span>
                                    </a>
                                    <a href="#!" class="grid-nav-item">
                                        <div class="grid-nav-icon"><i class="far fa-bell"></i></div>
                                        <span class="grid-nav-content">Notification</span>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                        <div class="card-footer card-footer-bordered rounded-0"><a href="{{ route('logout') }}"
                                class="btn btn-label-danger">Sign out</a></div>
                    </div>
                </div>
            </div>
            <!-- End Profile -->
        </div>
    </div>
    <!-- End menu -->
</div>
