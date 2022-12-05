<nav
    class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="#">
                        <i class="ft-menu font-large-1"></i></a>
                    </li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="/"><img class="brand-logo" alt="modern admin logo"
                            src="{{ asset('app-assets/images/logo/logo.png') }}">

                        <h6 class="brand-text" style="margin-top: 5px">{{ getAppName() }}</h6>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link"  data-toggle="dropdown">
                            <span class="mr-1 user-name text-bold-700">
                                {{ Str::title(auth()->user()->full_name) }}
                            </span>
                            <span class="avatar avatar-online">
                                <img src="{{ getUserProfile() }}" alt="avatar">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('admin.profile.index')}}">
                                <i class="material-icons">person_outline</i>
                                Profile
                            </a>
                            {{-- <a class="dropdown-item" href="app-email.html"><i class="material-icons">mail_outline</i> MyInbox</a> --}}
                            {{-- <a class="dropdown-item" href="user-cards.html"><i class="material-icons">content_paste</i> Task</a> --}}
                            {{-- <a class="dropdown-item" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chats</a> --}}
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item" href="login-with-bg-image.html">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <span id="logout"  style="cursor: pointer">
                                        <i class="material-icons">power_settings_new</i>
                                        Se déconnecter
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right d-none">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1 user-name text-capitalize text-bold-700">
                                {{ auth()->user()->full_name }}
                            </span>
                            <span class="avatar avatar-online">
                                <img src="{{ getUserProfile() }}" alt="avatar">
                                <i></i>
                            </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item" style="cursor: pointer">
                                    <i class="material-icons">power_settings_new</i>
                                    Se déconnecter
                                </button>
                            </form>
                        </div>
                    </li>

                    {{-- <a href="{{route('admin.profile.index')}}" class="dropdown-item">
                        <i class="material-icons">power_settings_new</i>
                        Se déconnecter
                    </a> --}}
                </ul>
            </div>
        </div>
    </div>
</nav>
