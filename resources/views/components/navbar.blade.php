<!-- Include this at the very top of your master layout or partial -->
<header class="custom-header" id="site-header">
    <div class="nav-container">
        
        <!-- LEFT: Logo & Mobile Hamburger -->
        <div class="nav-left">
            <!-- Mobile Hamburger Button -->
            <button class="mobile-menu-btn" id="openMenuBtn" aria-label="Open Menu">
                <i class="bi bi-list"></i>
            </button>
            
            <a href="{{ url(app()->getLocale().'/') }}" class="logo-link">
                <x-application-logo/>
            </a>
        </div>

        <!-- CENTER: Search Bar (Desktop Only) -->
        <div class="nav-center desktop-only">
            <form action="{{ route('search') }}" method="GET" class="custom-search-form">
                <input type="search" name="query" class="custom-search-input" placeholder="@lang('common.search')" value="{{ request('query') }}">
                <button type="submit" class="custom-search-submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <!-- RIGHT: Links & Actions -->
        <div class="nav-right">
            
            <!-- Desktop Links -->
            <nav class="desktop-nav-links desktop-only">
                <a href="{{ url(app()->getLocale().'/') }}" class="nav-links {{ request()->is(app()->getLocale()) || request()->is(app()->getLocale().'/') ? 'active' : '' }}">@lang('common.home')</a>
                <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="nav-links {{ request()->is('*/stores*') ? 'active' : '' }}">@lang('common.stores')</a>

                <!-- Categories Dropdown -->
                <a href="{{ route('category', ['lang' => app()->getLocale()]) }}" class="nav-links {{ request()->is('*/category*') ? 'active' : '' }}">@lang('common.categories')</a>
                <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="nav-links {{ request()->is('*/blog*') ? 'active' : '' }}">@lang('common.blogs')</a>
                <a href="{{ route('contact', ['lang' => app()->getLocale()]) }}" class="nav-links {{ request()->is('*/contact*') ? 'active' : '' }}">@lang('common.contact')</a>
            </nav>

            <!-- Search Icon (Mobile Only) -->
            <a href="{{ route('search') }}" class="mobile-search-btn mobile-only">
                <i class="bi bi-search"></i>
            </a>

            <!-- Language Selector -->
            <div class="custom-dropdown language-dropdown">
                <button class="lang-pill-btn dropdown-trigger">
                    <img src="{{ $langs->firstWhere('code', app()->getLocale())->flag_url }}" width="18" height="13" style="object-fit: cover; border-radius: 2px;">
                    <span class="lang-text">{{ strtoupper(app()->getLocale()) }}</span>
                    <i class="bi bi-chevron-down" style="font-size: 10px;"></i>
                </button>
                <div class="dropdown-content dropdown-right">
                    @foreach ($langs as $lang)
                        <a href="{{ url('/' . $lang->code) }}" class="lang-item">
                            <img src="{{ $lang->flag_url }}" width="18" height="13" style="object-fit: cover; border-radius: 2px;">
                            {{ $lang->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</header>

<!-- IMPORTANT: Spacer to prevent content from hiding under the fixed header -->
<div class="header-spacer"></div>

<!-- ========================================== -->
<!-- MOBILE MENU DRAWER & OVERLAY                -->
<!-- ========================================== -->
<div class="mobile-menu-overlay" id="mobileOverlay"></div>

<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-header">
        <button class="drawer-close-btn" id="closeMenuBtn">
            <i class="bi bi-x-lg"></i>
        </button>
        <!-- Mobile Language inside drawer -->
        <div class="custom-dropdown language-dropdown">
            <button class="lang-pill-btn dropdown-trigger">
                <img src="{{ $langs->firstWhere('code', app()->getLocale())->flag_url }}" width="18" height="13" style="object-fit: cover; border-radius: 2px;">
                <span class="lang-text">{{ strtoupper(app()->getLocale()) }}</span>
                <i class="bi bi-chevron-down" style="font-size: 10px;"></i>
            </button>
            <div class="dropdown-content dropdown-right">
                @foreach ($langs as $lang)
                    <a href="{{ url('/' . $lang->code) }}" class="lang-item">
                        <img src="{{ $lang->flag_url }}" width="18" height="13" style="object-fit: cover; border-radius: 2px;">
                        {{ $lang->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="drawer-body">
        <a href="{{ url(app()->getLocale().'/') }}" class="drawer-link">@lang('common.home')</a>
        <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="drawer-link">@lang('common.stores')</a>
        <a href="{{ route('category', ['lang' => app()->getLocale()]) }}" class="drawer-link">@lang('common.categories')</a>
        <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="drawer-link">@lang('common.blogs')</a>
        <a href="{{ route('about', ['lang' => app()->getLocale()]) }}" class="drawer-link">@lang('common.contact')</a>
    </div>
</div>