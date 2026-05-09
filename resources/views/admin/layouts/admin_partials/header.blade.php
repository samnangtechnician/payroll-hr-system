<header class="top-header">
  <nav class="navbar navbar-expand">
    <div class="mobile-toggle-icon d-xl-none">
      <i class="bi bi-list"></i>
    </div>

    <div class="top-navbar d-none d-xl-block">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-1"></i> {{ __('menu.dashboard') }}
          </a>
        </li>
      </ul>
    </div>

    <div class="ms-auto"></div>

    <div class="top-navbar-right ms-3">
      <ul class="navbar-nav align-items-center gap-2">

        {{-- Language Switcher (Vue SFC). Falls back to plain links if JS is disabled. --}}
        <li class="nav-item">
          <language-switcher></language-switcher>

          <noscript>
            <div class="d-inline-flex gap-1">
              <a href="?lang=en" class="btn btn-sm btn-outline-secondary">EN</a>
              <a href="?lang=km" class="btn btn-sm btn-outline-secondary">KM</a>
            </div>
          </noscript>
        </li>

        {{-- User Menu --}}
        <li class="nav-item dropdown dropdown-large">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="user-setting d-flex align-items-center gap-1">
              <span class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                    style="width:36px;height:36px;font-weight:600;">
                {{ strtoupper(mb_substr(auth()->user()?->name ?? 'U', 0, 1)) }}
              </span>
              <div class="user-name d-none d-sm-block ms-2">
                {{ auth()->user()?->name }}
              </div>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <span class="dropdown-item-text">
                <strong>{{ auth()->user()?->name }}</strong>
                <small class="d-block text-muted">{{ auth()->user()?->email }}</small>
              </span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                @csrf
                <button class="dropdown-item text-danger" type="submit">
                  <i class="bi bi-box-arrow-right me-2"></i> {{ __('common.logout') }}
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
