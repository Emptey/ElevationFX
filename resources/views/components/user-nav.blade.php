<div class="dashboard-menu  fixed-top">
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    <div class="nav-control" style="margin-bottom: 4%; padding-top: 3%">
        <span style="color: #fff; text-align:center">
            <a href="{{ route('get-user-home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo" />
            </a>
        </span>

        <span class="menu-bar">
            <i class="fa fa-bars float-right" style="margin-right: 3%; font-size: 16pt; color: #fff" id="menu-bar"></i>
        </span>
    </div>

    <div class="x1-5-margin-top menu-hidden">
        <span style="color: #fff; text-align:center">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo-mobile"/>
        </span>
        <nav class="nav flex-column">
            <a class="nav-link {{ Route::is('get-user-dashboard') ? 'active': '' }}" href="{{ route('get-user-dashboard') }}"> <i class="fa fa-tachometer"></i> overview </a>
            <a class="nav-link {{ Route::is('get-user-profile') || Route::is('get-edit-user-profile') || Route::is('get-user-settings') ? 'active': '' }}" href="{{ route('get-user-profile') }}"> <i class="fa fa-user"></i> profile </a>
            <a class="nav-link {{ Route::is('get-user-resource') || Route::is('search-user-resource') ? 'active' : '' }}" href="{{ route('get-user-resource') }}"> <i class="fa fa-file"></i> resources </a>
            <a class="nav-link {{ Route::is('get-user-class') ? 'active' : '' }}" href="{{ route('get-user-class') }}"> <i class="fa fa-edit"></i> classes </a>
            <a class="nav-link  {{ Route::is('get-user-investment') || Route::is('user-investment-pay') ? 'active' : '' }}" href="{{ route('get-user-investment') }}"> <i class="fa fa-briefcase"></i> investment </a>
        </nav>
    </div>

</div>