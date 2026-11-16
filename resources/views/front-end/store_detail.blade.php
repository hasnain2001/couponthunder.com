@extends('layouts.master')

@section('title')
    @if ($store->title)
        {{ $store->title }}
    @else
        {{ __('store-detail.meta_title_fallback', ['store' => $store->name, 'year' => date('Y'), 'app' => config('app.name')]) }}
    @endif
@endsection

@section('description')
    @if ($store->meta_description)
        {{ $store->meta_description }}
    @else
        {{ __('store-detail.meta_description_fallback', ['store' => $store->name, 'app' => config('app.name')]) }}
    @endif
@endsection

@section('keywords')
    @if ($store->meta_keyword)
        {{ $store->meta_keyword }}, {{ $store->name }} discounts, {{ $store->name }} promo codes
    @else
        {{ __('store-detail.meta_keywords_fallback', ['store' => $store->name]) }}
    @endif
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/store-detail.css') }}">
@endpush

@section('content')
    @php
        $codeCount = 0;
        $dealCount = 0;
        foreach ($coupons as $coupon) {
            if ($coupon->code) { $codeCount++; } else { $dealCount++; }
        }
        $totalCount = $codeCount + $dealCount;
    @endphp

    <main class="main overflow-hidden">
        <!-- ===== BREADCRUMB ===== -->
        <section class="breadcrumb-section" aria-label="Breadcrumb">
            <div class="container px-0 px-md-4">
                <div class="breadcrumb-wrapper">
                    <nav class="breadcrumb-nav w-100">
                        <div class="breadcrumb-container">
                            <a href="{{ url(app()->getLocale() . '/') }}" class="breadcrumb-item">
                                <span class="breadcrumb-text">{{ __('common.home') }}</span>
                            </a>
                            <span class="breadcrumb-separator"><i class="fas fa-chevron-right text-muted" style="font-size: 0.6rem;"></i></span>

                            @if(!empty($store->category))
                                <a href="{{ route('category.detail', ['slug' => $store->category->slug]) }}" class="breadcrumb-item">
                                    <span class="breadcrumb-text">{{ $store->category->name }}</span>
                                </a>
                                <span class="breadcrumb-separator"><i class="fas fa-chevron-right text-muted" style="font-size: 0.6rem;"></i></span>
                            @endif

                            <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="breadcrumb-item">
                                <span class="breadcrumb-text">{{ __('common.stores') }}</span>
                            </a>
                            <span class="breadcrumb-separator"><i class="fas fa-chevron-right text-muted" style="font-size: 0.6rem;"></i></span>

                            <div class="breadcrumb-item current" aria-current="page">
                                <span class="breadcrumb-text">{{ $store->name }}</span>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </section>

        <!-- ===== STORE HEADER ===== -->
        <header class="store-header-section">
            <div class="container px-0 px-md-4">
                <div class="row align-items-center g-3">
                    <div class="col-4 col-md-3 col-lg-2 text-center text-md-start">
                        <img src="{{ $store->image_url }}" class="store-logo-img" alt="{{ $store->name }}" loading="lazy">
                    </div>
                    <div class="col-8 col-md-9 col-lg-10">
                        <div class="store-info">
                            <h1>{{ __('store-detail.header_title', ['store' => $store->name, 'year' => date('Y'), 'month' => date('F')]) }}</h1>
                            
                            <div class="store-rating d-flex align-items-center gap-2 mb-2 justify-content-center justify-content-md-start">
                                <span class="stars text-warning">⭐⭐⭐⭐⭐</span>
                                <span class="text-muted small fw-semibold">(4.8/5)</span>
                            </div>
                            
                            <p class="store-tagline d-none d-md-block">{{ $store->description ?? __('store-detail.default_description', ['store' => $store->name, 'year' => date('Y'), 'month' => date('F'), 'app' => config('app.name')]) }}</p>
                            
                            <div class="store-stats-badges justify-content-center justify-content-md-start">
                                <span class="badge stat-badge"><i class="fas fa-tag"></i> {{ $totalCount }} {{ __('store-detail.total_offers') }}</span>
                                <span class="badge stat-badge stat-badge-code"><i class="fas fa-code"></i> {{ $codeCount }} {{ __('store-detail.codes') }}</span>
                                <span class="badge stat-badge stat-badge-deal"><i class="fas fa-percent"></i> {{ $dealCount }} {{ __('store-detail.deals') }}</span>
                            </div>

                            <div class="mt-3 text-center text-md-start">
                                <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-golden" rel="nofollow noopener">
                                    <i class="fas fa-external-link-alt me-2"></i>{{ __('store-detail.visit_store') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ===== FILTER BAR ===== -->
        <div class="filter-bar-wrapper">
            <div class="filter-bar" role="tablist">
                <div class="container px-0 px-md-4">
                    <div class="btn-group" role="group">
                        <a href="{{ url()->current() }}" class="btn {{ !request()->has('sort') ? 'active' : '' }}" role="tab">
                            {{ __('store-detail.all') }} <span class="badge">{{ $totalCount }}</span>
                        </a>
                        <a href="{{ url()->current() }}?sort=codes" class="btn {{ request('sort') == 'codes' ? 'active' : '' }}" role="tab">
                            {{ __('store-detail.codes') }} <span class="badge">{{ $codeCount }}</span>
                        </a>
                        <a href="{{ url()->current() }}?sort=deals" class="btn {{ request('sort') == 'deals' ? 'active' : '' }}" role="tab">
                            {{ __('store-detail.deals') }} <span class="badge">{{ $dealCount }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== MAIN CONTENT ===== -->
        <section class="store-content-section py-3 py-md-4 bg-light-custom">
            <div class=" px-0 px-md-4">
                <div class="row g-3 g-md-4">
                    
                    <!-- SIDEBAR -->
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="sticky-wrapper">
                            <div class="sidebar-accordion accordion" id="sidebarAccordion">
                                
                                <!-- About Store -->
                                <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                                    <h2 class="accordion-header" id="headingAbout">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAbout" aria-expanded="true" aria-controls="collapseAbout">
                                            <i class="fas fa-store me-2 text-primary"></i> {{ __('store-detail.about_store', ['store' => $store->name]) }}
                                        </button>
                                    </h2>
                                    <div id="collapseAbout" class="accordion-collapse collapse show" aria-labelledby="headingAbout" data-bs-parent="#sidebarAccordion">
                                        <div class="accordion-body bg-white p-4 text-center">
                                            <img src="{{ $store->image_url }}" class="rounded-circle shadow-sm mb-3" style="width:100px;height:100px;object-fit:contain;border:3px solid var(--primary-lighter);" alt="{{ $store->name }}" loading="lazy">
                                            <p class="small text-muted mb-4">{{ $store->about ?? __('store-detail.no_description') }}</p>
                                            <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-golden w-100 py-2" rel="nofollow noopener">
                                                <i class="fas fa-external-link-alt me-2"></i>{{ __('store-detail.visit_store') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Similar Stores -->
                                @if(isset($relatedStores) && $relatedStores->isNotEmpty())
                                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                                        <h2 class="accordion-header" id="headingSimilar">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSimilar" aria-expanded="false" aria-controls="collapseSimilar">
                                                <i class="fas fa-store-alt me-2 text-primary"></i> {{ __('store-detail.similar_stores') }}
                                            </button>
                                        </h2>
                                        <div id="collapseSimilar" class="accordion-collapse collapse" aria-labelledby="headingSimilar" data-bs-parent="#sidebarAccordion">
                                            <div class="accordion-body bg-white p-2">
                                                <div class="d-flex flex-column gap-2">
                                                    @foreach ($relatedStores as $relatedStore)
                                                        <a href="{{ route('store.detail', ['slug' => ($relatedStore->slug)]) }}" class="related-store-item p-2 rounded-3 text-decoration-none">
                                                            <img src="{{ $relatedStore->image_url }}" class="related-store-image bg-white" alt="{{ $relatedStore->name }}" loading="lazy">
                                                            <div class="flex-grow-1 min-w-0">
                                                                <h3 class="fw-bold mb-0 text-truncate text-dark" style="font-size:0.9rem;">{{ $relatedStore->name }}</h3>
                                                                <small class="text-muted d-block"><i class="fas fa-tag me-1 text-primary"></i>{{ $relatedStore->coupons()->count() ?? 0 }} {{ __('store-detail.offers') }}</small>
                                                            </div>
                                                            <i class="fas fa-chevron-right text-muted small"></i>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- COUPONS GRID -->
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="coupons-grid-container px-2 px-md-0">
                            @if($coupons->isEmpty())
                                <div class="empty-state text-center py-5 bg-white rounded-4 shadow-sm mx-2 mx-md-0">
                                    <div class="empty-icon mb-3">
                                        <i class="fas fa-tag fa-3x text-muted opacity-50"></i>
                                    </div>
                                    <h2 class="h5 mb-2 fw-bold">{{ __('store-detail.no_coupons_title') }}</h2>
                                    <p class="text-muted small">{{ __('store-detail.no_coupons_text') }}</p>
                                    <a href="{{ route('stores') }}" class="btn btn-golden btn-sm mt-3 rounded-pill px-4">{{ __('store-detail.explore_brands') }}</a>
                                </div>
                            @else
                                <div class="row g-2 g-md-3">
                                    @foreach ($coupons as $coupon)
                                        <div class="col-6 col-md-4 col-xl-3">
                                            <article class="coupon-card h-100" itemscope itemtype="https://schema.org/Offer">
                                                <meta itemprop="availability" content="https://schema.org/InStock" />
                                                <meta itemprop="price" content="0" />
                                                <meta itemprop="priceCurrency" content="USD" />

                                                <div class="coupon-type-badge {{ $coupon->code ? 'badge-code' : 'badge-deal' }}">
                                                    <i class="fas {{ $coupon->code ? 'fa-tag' : 'fa-percent' }} me-1"></i>
                                                    {{ $coupon->code ? __('store-detail.code') : __('store-detail.deal') }}
                                                </div>

                                                @if($coupon->clicks > 50)
                                                    <div class="hot-offer-ribbon"><i class="fas fa-fire me-1"></i>{{ __('store-detail.hot') }}</div>
                                                @endif

                                                <div class="card-body d-flex flex-column">
                                                    <div class="text-center mb-2">
                                                        <img src="{{ $store->image_url }}" class="coupon-store-image" alt="{{ $store->name }}" loading="lazy" itemprop="image">
                                                    </div>

                                                    <h3 class="coupon-title text-center" itemprop="name">{{ Str::limit($coupon->name, 50) }}</h3>

                                                    @if($coupon->description)
                                                        <p class="coupon-description text-center d-none d-sm-block" itemprop="description">{{ Str::limit($coupon->description, 60) }}</p>
                                                    @endif

                                                    <div class="coupon-meta mt-auto">
                                                        <span class="ending-date {{ \Carbon\Carbon::parse($coupon->ending_date)->isPast() ? 'text-danger' : '' }}">
                                                            <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d') }}
                                                        </span>
                                                        <span class="used-count"><i class="fas fa-users me-1"></i><span id="usedCount{{ $coupon->id }}">{{ $coupon->clicks }}</span></span>
                                                    </div>

                                                    <div class="mt-2">
                                                        @if ($coupon->code)
                                                            <button class="btn btn-get-code w-100" onclick="handleRevealCode(event, {{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ $store->image_url }}', '{{ $store->destination_url }}', '{{ $store->name }}')">
                                                                <i class="fas fa-gift me-1"></i>{{ __('store-detail.get_code') }}
                                                            </button>
                                                        @else
                                                            <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-deal w-100" rel="nofollow noopener" onclick="updateClickCount('{{ $coupon->id }}')">
                                                                <i class="fas fa-bolt me-1"></i>{{ __('store-detail.view_deal') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Content / Related Blogs -->
                        @if ($store->content || $relatedblogs->isNotEmpty())
                            <div class="content-section mt-4 px-2 px-md-0">
                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                    <div class="card-body p-3 p-md-5">
                                        @if ($store->content)
                                            <div class="content" itemprop="description">
                                                {!! $store->content !!}
                                            </div>
                                        @elseif ($relatedblogs->isNotEmpty())
                                            <h2 class="h4 fw-bold mb-4">{{ __('store-detail.related_articles') }}</h2>
                                            @foreach ($relatedblogs as $blog)
                                                <article class="blog-item mb-4 pb-4 border-bottom">
                                                    <h3 class="blog-title h5 fw-bold text-dark">{{ $blog->title }}</h3>
                                                    @if($blog->image)
                                                        <img src="{{ $blog->image_url }}" class="blog-img w-100 rounded-3 mb-3" alt="{{ $blog->title }}" loading="lazy" itemprop="image">
                                                    @endif
                                                    <div class="content">
                                                        {!! $blog->content !!}
                                                    </div>
                                                    <a href="{{ route('blog.detail', ['slug' => ($blog->slug)]) }}" class="btn btn-outline-golden btn-sm rounded-pill mt-2">
                                                        {{ __('common.read_more') }} <i class="fas fa-arrow-right ms-1"></i>
                                                    </a>
                                                </article>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ===== STICKY "VISIT STORE" BUTTON ===== -->
    <div class="sticky-visit-store">
        <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-golden" rel="nofollow noopener">
            <i class="fas fa-external-link-alt me-2"></i>{{ __('store-detail.visit_store') }}
        </a>
    </div>

    <!-- ===== COUPON MODAL ===== -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm-custom">
            <div class="modal-content border-0">
                <div class="modal-header justify-content-center bg-primary-gradient text-white border-0 py-3">
                    <h5 class="modal-title fw-bold text-center"><i class="fas fa-gift me-2"></i>{{ __('store-detail.exclusive_discount') }}</h5>
                    <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="mb-3">
                        <img src="" alt="Brand Logo" id="storeImage" class="rounded-circle shadow-sm" style="width:80px;height:80px;object-fit:contain;border:2px solid var(--primary-lighter);" loading="lazy">
                    </div>
                    <h6 class="fw-bold mb-3" id="couponName"></h6>
                    
                    <div class="bg-light rounded-3 p-3 mb-4 border border-warm">
                        <p class="small text-muted mb-2"><i class="fas fa-tag me-1"></i>{{ __('store-detail.your_exclusive_code') }}</p>
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <span id="couponCode" class="fw-bold coupon-code-text"></span>
                            <button class="btn copy-btn" onclick="copyToClipboard()" aria-label="Copy code"><i class="fas fa-copy"></i></button>
                        </div>
                        <p id="copyMessage" class="small text-success fw-bold mt-2 mb-0" style="display:none;"><i class="fas fa-check-circle me-1"></i>{{ __('store-detail.copied') }}</p>
                    </div>
                    
                    <a href="" id="storeLink" class="btn btn-golden btn-lg w-100 rounded-pill" target="_blank" rel="nofollow noopener">
                        <i class="fas fa-external-link-alt me-2"></i>{{ __('store-detail.redeem_now') }}
                    </a>
                    <p class="small text-muted mt-3 mb-0">
                        <i class="fas fa-info-circle me-1"></i>{{ __('store-detail.apply_code') }}
                        <a href="" id="couponUrl" class="text-decoration-none fw-semibold text-dark" target="_blank" rel="nofollow noopener"></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-scroll breadcrumb to current item on mobile
        if (window.innerWidth <= 576) {
            const current = document.querySelector('.breadcrumb-item.current');
            if (current) {
                setTimeout(() => {
                    current.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                }, 300);
            }
        }
    });

    // Coupon modal logic
    let couponModal = null;
    document.addEventListener('DOMContentLoaded', function() {
        couponModal = new bootstrap.Modal(document.getElementById('couponModal'));
    });

    function handleRevealCode(event, couponId, couponCode, couponName, storeImage, destinationUrl, storeName) {
        event.preventDefault();

        document.getElementById('couponCode').textContent = couponCode;
        document.getElementById('couponName').textContent = couponName;
        document.getElementById('storeImage').src = storeImage;
        document.getElementById('couponUrl').href = destinationUrl;
        document.getElementById('couponUrl').textContent = storeName;
        document.getElementById('storeLink').href = destinationUrl;

        updateClickCount(couponId);

        if (couponModal) {
            couponModal.show();
            setTimeout(() => {
                window.open(destinationUrl, '_blank');
            }, 500);
        } else {
            window.open(destinationUrl, '_blank');
        }
    }

    function updateClickCount(couponId) {
        fetch('{{ route("update.clicks") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ coupon_id: couponId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const el = document.getElementById('usedCount' + couponId);
                if (el) el.textContent = data.clicks;
            }
        })
        .catch(console.error);
    }

    function copyToClipboard() {
        const code = document.getElementById('couponCode').textContent;
        navigator.clipboard.writeText(code).then(() => {
            const msg = document.getElementById('copyMessage');
            msg.style.display = 'block';
            setTimeout(() => { msg.style.display = 'none'; }, 3000);
        });
    }
</script>
@endpush