<div class="header text-right">
    <!-- Very little is needed to make a happy life. - Marcus Antoninus -->
    <ul>
        <li>
            <a href="{{ route('admin-settings') }}" class="{{ Route::is('admin-settings') ? 'active' : '' }}"><i class="fa fa-cog"></i></a>
        </li>

        <li>
            <a href="{{ route('admin-logout') }}"><i class="fa fa-power-off"></i></a>
        </li>

    </ul>
</div>