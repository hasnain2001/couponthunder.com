
<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- ===== CHARACTER SET & VIEWPORT ===== --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- ===== DYNAMIC TITLE & META ===== --}}
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', 'Find verified coupon codes, promo deals, and discounts updated daily on ' . config('app.name'))">
    <meta name="keywords" content="@yield('keywords', 'coupon codes, discount coupons, promo codes, deals, vouchers, ' . config('app.name'))">

    {{-- ===== ROBOTS (per-page override via @section('robots')) ===== --}}
    <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">
    <meta name="googlebot" content="@yield('robots', 'index, follow')">
    <meta name="bingbot" content="@yield('robots', 'index, follow')">

    {{-- ===== AUTHOR & PUBLISHER ===== --}}
    <meta name="author" content="@yield('author', config('app.name'))">
    <meta name="publisher" content="{{ config('app.name') }}">

    {{-- ===== CANONICAL ===== --}}
    <link rel="canonical" href="{{ request()->url() }}">


    {{-- ===== FAVICON ===== --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">

    {{-- ===== MAIN CSS ===== --}}
    <link rel="stylesheet" href="{{ asset('assets/css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">

    {{-- ===== BOOTSTRAP & ICONS (deferred) ===== --}}
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet" media="print" onload="this.media='all'">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"
          media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">


    {{-- ===== PAGE-SPECIFIC JSON-LD (pushed by child views) ===== --}}
    @stack('schema')

    {{-- ===== PAGE-SPECIFIC STYLES ===== --}}
    @stack('styles')
</head>

<body class="d-flex flex-column h-100">

    {{-- ===== HEADER ===== --}}
    {{-- <header role="banner">
        <x-navbar />
    </header> --}}

    {{-- ===== MAIN CONTENT ===== --}}
    <main id="main-content" class="flex-shrink-0" role="main">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    {{-- <footer class="mt-auto" role="contentinfo">
        <x-footer />
    </footer> --}}

    {{-- ===== SCRIPTS ===== --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/navbar.js') }}" defer></script>
    <script src="{{ asset('assets/js/footer.js') }}" defer></script>

    {{-- ===== PAGE-SPECIFIC SCRIPTS ===== --}}
    @stack('scripts')
</body>
</html>