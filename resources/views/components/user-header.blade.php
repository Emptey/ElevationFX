<div class="header">
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
    <ul class="nav">
        <li>
            <a href="{{ route('get-user-notification') }}" class="{{ Route::is('get-user-notification') ? 'active' : '' }}">
                <i class="fa fa-bell" aria-hidden="true"></i>
            </a>
        </li>

        <li>
            <a href="{{ route('get-user-logout') }}">
                <i class="fa fa-power-off" aria-hidden="true"></i>
            </a>
        </li>

    </ul>
</div>