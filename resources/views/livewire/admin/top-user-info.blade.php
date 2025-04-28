<div class="user-info-dropdown mr-3">
    <div class="dropdown">
        <a
            class="dropdown-toggle"
            href="#"
            role="button"
            data-toggle="dropdown"
        >
            <span class="user-icon">
                <img src="{{ $user->picture }}" alt=""/>
            </span>
            <span class="user-name">{{ $user->firstname . ' ' . $user->lastname }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="dw dw-user1"></i> Профиль</a>
            <a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="dw dw-settings2"></i> Настройки</a>
            <a
                class="dropdown-item"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            >
                <i class="dw dw-logout"></i> Выйти
            </a>
            <form action="{{ route('logout') }}" id="logout-form" method="POST">
                @csrf
            </form>
        </div>
    </div>
</div>


