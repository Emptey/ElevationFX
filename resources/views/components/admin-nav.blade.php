<div class="no-padding admin-nav">
    <div class="text-center" style="margin-bottom: 4%; padding-top: 3%">
        <img src="{{ asset('img/logo.png') }}" alt="" class="logo">
    </div>

    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    <div class="x1-5-margin-top">
        <nav class="nav flex-column">
            <a class="nav-link {{ Route::is('admin-dashboard') ? 'active-link': '' }}" href="{{ route('admin-dashboard') }}"> <i class="fa fa-tachometer"></i> Dashboard</a>
            <a class="nav-link {{ Route::is('get-users') || Route::is('search-user') || Route::is('user-status') || Route::is('user-record') ? 'active-link': '' }}" href="{{ route('get-users') }}"> <i class="fa fa-users"></i> User Management</a>
            <a class="nav-link {{ Route::is('get-admin') || Route::is('add-admin') ? 'active-link' : '' }}" href="{{ route('get-admin') }}"> <i class="fa fa-user-secret"></i> Admin Management</a>
            <a class="nav-link {{ Route::is('user-course') || Route::is('course-status') || Route::is('add-course') || Route::is('view-course') || Route::is('edit-course') ? 'active-link' : '' }}" href="{{ route('user-course') }}"> <i class="fa fa-calendar"></i> Course Management</a>
            <a class="nav-link  {{ Route::is('user-class') || Route::is('add-class') ? 'active-link' : '' }}" href="{{ route('user-class') }}"> <i class="fa fa-comments"></i> Class Management</a>
            <a class="nav-link  {{ Route::is('user-resource') || Route::is('add-resource') ? 'active-link' : '' }}" href="{{ route('user-resource') }}"> <i class="fa fa-file-pdf-o"></i> Resource Management</a>
            <a class="nav-link {{ Route::is('user-investment') || Route::is('add-investment') || Route::is('edit-investment') || Route::is('view-investment') ? 'active-link' : '' }}" href="{{ route('user-investment') }}"> <i class="fa fa-line-chart"></i> Investment Management</a>
            <a class="nav-link {{ Route::is('user-notification') || Route::is('create-notification') || Route::is('notification-search') || Route::is('notification-status') ? 'active-link' : '' }}" href="{{ route('user-notification') }}"> <i class="fa fa-bell"></i> Notification Management</a>
        </nav>
    </div>

</div>