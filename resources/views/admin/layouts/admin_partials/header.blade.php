<header class="top-header">
  <nav class="navbar navbar-expand">
    <button type="button" class="mobile-toggle-icon d-xl-none border-0 bg-transparent p-0" aria-label="Toggle navigation">
      <i class="bi bi-list"></i>
    </button>

    <div class="top-navbar d-none d-xl-flex header-context">
      <div class="header-context-link" aria-current="page">
        <span class="header-context-icon">
          <i class="bi bi-speedometer2"></i>
        </span>
        <span class="header-context-meta">@yield('pageTitle', __('menu.dashboard'))</span>
      </div>
    </div>

    <div class="ms-auto"></div>

    <div class="top-navbar-right header-actions ms-3">
      <ul class="navbar-nav align-items-center flex-row gap-2">

        <li class="nav-item">
          <details class="language-dropdown">
            <summary class="header-language-trigger">
              <span class="header-language-chip">
                <span class="header-language-icon">
                  <i class="bi bi-translate"></i>
                </span>
                <span class="header-language-label d-none d-md-inline">
                  {{ app()->getLocale() === 'km' ? 'Khmer' : 'English' }}
                </span>
                <span class="header-language-code">{{ strtoupper(app()->getLocale()) }}</span>
              </span>
            </summary>

            <div class="language-menu">
              <form method="POST" action="{{ route('locale.store') }}" class="m-0 p-0">
                @csrf
                <input type="hidden" name="locale" value="en">
                <button class="dropdown-item language-menu-item{{ app()->getLocale() === 'en' ? ' active' : '' }}"
                  type="submit">
                  <span class="language-menu-code">EN</span>
                  <span class="language-menu-text">English</span>
                </button>
              </form>
              <form method="POST" action="{{ route('locale.store') }}" class="m-0 p-0">
                @csrf
                <input type="hidden" name="locale" value="km">
                <button class="dropdown-item language-menu-item{{ app()->getLocale() === 'km' ? ' active' : '' }}"
                  type="submit">
                  <span class="language-menu-code">KM</span>
                  <span class="language-menu-text">ភាសាខ្មែរ</span>
                </button>
              </form>
            </div>
          </details>
        </li>

        {{-- User Menu --}}
        <li class="nav-item">
          <details class="account-dropdown">
            <summary class="nav-link header-user-trigger">
              <span class="user-setting">
                <span class="header-avatar">
                  {{ strtoupper(mb_substr(auth()->user()?->name ?? 'U', 0, 1)) }}
                </span>
                <span class="user-meta d-none d-md-flex">
                  <span class="user-name">{{ auth()->user()?->name }}</span>
                </span>
                <span class="user-caret d-none d-md-inline-flex" aria-hidden="true">
                  <i class="bi bi-chevron-down"></i>
                </span>
              </span>
            </summary>

            <div class="account-menu">
              <div class="dropdown-item-text">
                <strong>{{ auth()->user()?->name }}</strong>
                <small class="d-block text-muted">{{ auth()->user()?->email }}</small>
              </div>
              <hr class="dropdown-divider">
              <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                @csrf
                <button class="dropdown-item text-danger" type="submit">
                  <i class="bi bi-box-arrow-right me-2"></i> {{ __('common.logout') }}
                </button>
              </form>
            </div>
          </details>
        </li>
      </ul>
    </div>
  </nav>
</header>
