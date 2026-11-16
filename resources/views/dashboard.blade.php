@extends('layouts.auth')

@push('styles')
<style>
    :root {
        --ct-primary: #1E8A88;
        --ct-primary-dark: #146563;
    }

    /* Hero */
    .dash-hero {
        background: linear-gradient(135deg, var(--ct-primary) 0%, var(--ct-primary-dark) 100%);
        position: relative;
        overflow: hidden;
    }
    .dash-hero::after,
    .dash-hero::before {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        pointer-events: none;
    }
    .dash-hero::after  { width: 260px; height: 260px; top: -80px;  right: -60px; }
    .dash-hero::before { width: 180px; height: 180px; bottom: -90px; right: 120px; }

    /* Icon chips */
    .icon-chip {
        width: 44px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: .75rem;
        font-size: 1.15rem;
        flex-shrink: 0;
    }
    .icon-chip-lg { width: 56px; height: 56px; font-size: 1.4rem; border-radius: .9rem; }

    /* Hover lift for cards */
    .hover-lift { transition: transform .18s ease, box-shadow .18s ease; }
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 .75rem 1.5rem rgba(30,138,136,.12) !important;
    }

    /* Quick action tiles */
    .tile {
        display: flex;
        align-items: center;
        gap: .875rem;
        padding: 1rem 1.1rem;
        border-radius: .75rem;
        text-decoration: none;
        color: inherit;
        transition: background .15s ease, transform .15s ease;
    }
    .tile:hover {
        background: rgba(30,138,136,.06);
        transform: translateX(3px);
        color: inherit;
    }

    /* Activity list */
    .activity-list .list-group-item {
        border: 0;
        border-bottom: 1px dashed var(--bs-border-color);
        padding: .9rem 0;
    }
    .activity-list .list-group-item:last-child { border-bottom: 0; }

    /* Featured coupon card */
    .coupon-card {
        border: 1px solid var(--bs-border-color);
        border-radius: .875rem;
        background: var(--bs-body-bg);
        transition: border-color .15s ease, transform .15s ease;
        height: 100%;
    }
    .coupon-card:hover {
        border-color: var(--ct-primary);
        transform: translateY(-2px);
    }
    .coupon-code {
        background: rgba(30,138,136,.08);
        color: var(--ct-primary-dark);
        border: 1px dashed rgba(30,138,136,.4);
        border-radius: .5rem;
        padding: .35rem .75rem;
        font-family: ui-monospace, monospace;
        font-weight: 600;
        letter-spacing: .04em;
    }
</style>
@endpush

@section('content')
<div class="container py-4 py-lg-5">

    {{-- ============================================================ --}}
    {{-- 1. HERO / WELCOME                                          --}}
    {{-- ============================================================ --}}
    <div class="dash-hero text-white rounded-4 p-4 p-lg-5 mb-4">
        <div class="position-relative" style="z-index: 1;">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge rounded-pill bg-white bg-opacity-25 fw-medium mb-3">
                        <i class="bi bi-stars me-1"></i> Dashboard
                    </span>
                    <h1 class="h3 fw-bold mb-2">
                        Welcome back, {{ auth()->user()->name ?? 'User' }} 👋
                    </h1>
                    <p class="mb-0 text-white-50" style="max-width: 560px;">
                        Here's a snapshot of your account — track your coupons,
                        savings, and recent activity in one place.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="#" class="btn btn-light btn-lg fw-semibold shadow-sm">
                        <i class="bi bi-search me-2"></i> Find Coupons
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- 2. STAT CARDS                                              --}}
    {{-- ============================================================ --}}
    <div class="row g-3 g-lg-4 mb-4">
        @php
            $stats = [
                ['label' => 'Available Coupons', 'value' => '128',     'trend' => '+12%',       'icon' => 'bi-ticket-perforated', 'bg' => '#e6f4f3', 'fg' => '#1E8A88'],
                ['label' => 'Used This Month',   'value' => '17',      'trend' => '+4',         'icon' => 'bi-bag-check',         'bg' => '#fff4e5', 'fg' => '#f59e0b'],
                ['label' => 'Total Savings',     'value' => '$342.50', 'trend' => '+8%',        'icon' => 'bi-piggy-bank',        'bg' => '#e7f0ff', 'fg' => '#3b82f6'],
                ['label' => 'Favorites',         'value' => '24',      'trend' => 'Saved',      'icon' => 'bi-heart-fill',        'bg' => '#f0e9ff', 'fg' => '#8b5cf6'],
            ];
        @endphp

        @foreach ($stats as $s)
            <div class="col-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 hover-lift rounded-4">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="icon-chip" style="background:{{ $s['bg'] }}; color:{{ $s['fg'] }};">
                                <i class="bi {{ $s['icon'] }}"></i>
                            </span>
                            <span class="badge rounded-pill bg-success-subtle text-success-emphasis fw-medium">
                                {{ $s['trend'] }}
                            </span>
                        </div>
                        <div class="text-body-secondary small">{{ $s['label'] }}</div>
                        <div class="fs-4 fw-bold lh-1 mt-1">{{ $s['value'] }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ============================================================ --}}
    {{-- 3. MAIN GRID: QUICK ACTIONS + ACTIVITY + SAVINGS GOAL      --}}
    {{-- ============================================================ --}}
    <div class="row g-4 mb-4">

        {{-- 3a. Quick Actions --}}
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-header bg-body border-0 py-3 px-4 rounded-top-4">
                    <h2 class="h6 fw-semibold mb-0">
                        <i class="bi bi-lightning-charge-fill text-warning me-1"></i> Quick Actions
                    </h2>
                </div>
                <div class="card-body p-2">
                    @php
                        $actions = [
                            ['icon' => 'bi-search',           'bg' => '#e6f4f3', 'fg' => '#1E8A88', 'title' => 'Browse Coupons',  'sub' => 'Find codes from top stores', 'url' => '#'],
                            ['icon' => 'bi-star',             'bg' => '#fff4e5', 'fg' => '#f59e0b', 'title' => 'My Favorites',    'sub' => 'Your saved coupons',         'url' => '#'],
                            ['icon' => 'bi-clock-history',    'bg' => '#e7f0ff', 'fg' => '#3b82f6', 'title' => 'History',         'sub' => "Coupons you've used",        'url' => '#'],
                            ['icon' => 'bi-gear',             'bg' => '#f0e9ff', 'fg' => '#8b5cf6', 'title' => 'Account Settings','sub' => 'Update profile & password',  'url' => '#'],
                        ];
                    @endphp
                    @foreach ($actions as $a)
                        <a href="{{ $a['url'] }}" class="tile">
                            <span class="icon-chip" style="background:{{ $a['bg'] }}; color:{{ $a['fg'] }};">
                                <i class="bi {{ $a['icon'] }}"></i>
                            </span>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $a['title'] }}</div>
                                <div class="text-body-secondary small">{{ $a['sub'] }}</div>
                            </div>
                            <i class="bi bi-chevron-right text-body-tertiary"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 3b. Savings Goal (progress) --}}
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-header bg-body border-0 py-3 px-4 rounded-top-4 d-flex justify-content-between align-items-center">
                    <h2 class="h6 fw-semibold mb-0">
                        <i class="bi bi-bullseye text-primary me-1"></i> Monthly Savings Goal
                    </h2>
                    <span class="badge bg-primary-subtle text-primary-emphasis">68%</span>
                </div>
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <span class="fs-2 fw-bold">$342.50</span>
                        <span class="text-body-secondary small">of $500.00</span>
                    </div>
                    <div class="progress mb-3" role="progressbar" aria-label="Savings goal progress"
                         aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                        <div class="progress-bar rounded-pill"
                             style="width: 68%; background: linear-gradient(90deg, #1E8A88, #34d399);"></div>
                    </div>
                    <p class="text-body-secondary small mb-3">
                        You're <strong class="text-body">$157.50</strong> away from your goal.
                        Keep saving! 💪
                    </p>
                    <div class="mt-auto">
                        <button class="btn btn-outline-primary btn-sm w-100 fw-semibold">
                            <i class="bi bi-sliders me-1"></i> Adjust Goal
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3c. Recent Activity --}}
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-header bg-body border-0 py-3 px-4 rounded-top-4 d-flex justify-content-between align-items-center">
                    <h2 class="h6 fw-semibold mb-0">
                        <i class="bi bi-activity text-primary me-1"></i> Recent Activity
                    </h2>
                    <a href="#" class="small fw-semibold text-decoration-none" style="color:var(--ct-primary);">
                        View all
                    </a>
                </div>
                <div class="card-body px-4 pt-1 pb-3">
                    <ul class="list-unstyled activity-list mb-0">
                        @php
                            $activities = [
                                ['icon' => 'bi-ticket-perforated', 'bg' => '#e6f4f3', 'fg' => '#1E8A88', 'title' => 'Used coupon "SAVE20" at Amazon', 'sub' => 'You saved <strong>$12.00</strong>', 'time' => '2h ago'],
                                ['icon' => 'bi-star',              'bg' => '#fff4e5', 'fg' => '#f59e0b', 'title' => 'Saved 3 new coupons', 'sub' => 'From Nike, Adidas & Puma', 'time' => '5h ago'],
                                ['icon' => 'bi-person-check',      'bg' => '#e7f0ff', 'fg' => '#3b82f6', 'title' => 'Profile completed', 'sub' => 'Your account is fully set up', 'time' => '1d ago'],
                                ['icon' => 'bi-piggy-bank',        'bg' => '#f0e9ff', 'fg' => '#8b5cf6', 'title' => 'Reached $300 in savings 🎉', 'sub' => "You're on a roll!", 'time' => '2d ago'],
                            ];
                        @endphp
                        @foreach ($activities as $act)
                            <li class="list-group-item d-flex gap-3 align-items-start">
                                <span class="icon-chip" style="background:{{ $act['bg'] }}; color:{{ $act['fg'] }}; width:36px; height:36px; font-size:.9rem;">
                                    <i class="bi {{ $act['icon'] }}"></i>
                                </span>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold small">{{ $act['title'] }}</div>
                                    <div class="text-body-secondary small">{!! $act['sub'] !!}</div>
                                </div>
                                <span class="text-body-tertiary small text-nowrap">{{ $act['time'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- 4. FEATURED COUPONS                                        --}}
    {{-- ============================================================ --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-body border-0 py-3 px-4 rounded-top-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="h6 fw-semibold mb-0">
                <i class="bi bi-fire text-danger me-1"></i> Featured Coupons
            </h2>
            <a href="#" class="btn btn-sm btn-outline-secondary fw-semibold">
                View all <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="card-body p-3 p-lg-4">
            <div class="row g-3">
                @php
                    $coupons = [
                        ['store' => 'Amazon',  'discount' => '20% OFF', 'title' => 'Electronics & Accessories', 'code' => 'SAVE20',   'expires' => '2 days left', 'color' => '#ff9900'],
                        ['store' => 'Nike',    'discount' => '30% OFF', 'title' => 'Running Shoes & Gear',      'code' => 'RUN30',    'expires' => '5 days left', 'color' => '#111111'],
                        ['store' => 'Adidas',  'discount' => '$15 OFF', 'title' => 'Orders over $75',           'code' => 'ADIDAS15', 'expires' => '1 week left', 'color' => '#000000'],
                        ['store' => 'Uber Eats','discount' => 'FREE',   'title' => 'Delivery on first order',   'code' => 'EATS50',   'expires' => '3 days left', 'color' => '#06c167'],
                    ];
                @endphp
                @foreach ($coupons as $c)
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="coupon-card p-3 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fw-semibold" style="color: {{ $c['color'] }};">{{ $c['store'] }}</span>
                                <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis">{{ $c['discount'] }}</span>
                            </div>
                            <div class="fw-semibold small mb-3">{{ $c['title'] }}</div>
                            <div class="d-flex align-items-center gap-2 mt-auto">
                                <span class="coupon-code flex-grow-1 text-center small">{{ $c['code'] }}</span>
                                <button class="btn btn-sm btn-primary fw-semibold"
                                        onclick="navigator.clipboard.writeText('{{ $c['code'] }}'); this.innerHTML='<i class=\'bi bi-check2\'></i>';">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                            <div class="text-body-tertiary small mt-2">
                                <i class="bi bi-clock me-1"></i>{{ $c['expires'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- 5. FOOTER NOTE                                             --}}
    {{-- ============================================================ --}}
    <p class="text-center text-body-tertiary small mb-0">
        Logged in as <strong class="text-body">{{ auth()->user()->email ?? 'user' }}</strong>
    </p>
</div>
@endsection

@push('scripts')
@endpush