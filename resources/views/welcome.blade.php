@extends('layouts.master')

@section('title', __('welcome.meta_title'))
@section('description', __('welcome.meta_description'))

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">
@endpush

@section('content')

<!-- ======== HERO SECTION (SLIDER) ======== -->
@if($sliders->count() > 0)
<section class="container">
    <div id="heroSlider" class="carousel slide carousel-fade hero-section" data-bs-ride="carousel" data-bs-interval="5000" data-aos="fade-up">
        
        <!-- Indicators (Line style) -->
        <div class="carousel-indicators custom-indicators">
            @foreach($sliders as $index => $slider)
                <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row align-items-center h-100 mx-0">
                        
                        <!-- Left Text -->
                        <div class="col-lg-6 hero-content">
                            <h1 class="hero-title">{{ $slider->title ??  Null }}</h1>
                            <p class="hero-subtitle">
                                {{ $slider->subtitle ??  Null }}
                            </p>
                            <div class="mt-4">
                                <a href="{{ optional($slider->store)->destination_url ?? $slider->link ?? '#' }}" class="btn-hero">
                                    @lang('common.view_store')
                                </a>
                            </div>
                        </div>

                        <!-- Right Image -->
                        <div class="col-lg-6 hero-img-wrapper">
                            <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" class="slider-img">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

<!-- ======== TRENDING BLOGS ======== -->
<section class="container trending-section">
    <div class="text-center mb-4" data-aos="fade-up">
        <div class="trending-blob-badge">
            <span class="tb-title">{{ __('welcome.trending_blogs') }}</span>
            <span class="tb-subtitle">{{ __('welcome.by_brand', ['app' => config('app.name')]) }}</span>
        </div>
    </div>

    <div class="trending-grid" data-aos="fade-up">
        @if($topblogs->count() > 0)
            @php $mainBlog = $topblogs->first(); @endphp
            
            <!-- 1. Main Large Card (Top Left) -->
            <a href="{{ route('blog.detail', ['slug' => $mainBlog->slug]) }}" class="trending-main-card">
                <img src="{{ $mainBlog->image_url }}" alt="{{ $mainBlog->name }}" onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                <div class="card-overlay">
                    <span class="card-tag">{{ __('welcome.featured') }}</span>
                    <h3 class="h4 fw-bold mb-0 text-white">{{ Str::limit($mainBlog->name, 60) }}</h3>
                </div>
            </a>

            <!-- 2. Right Side Stacked Cards (Top Right) -->
            <div class="trending-sub-grid">
                @foreach($topblogs->skip(1)->take(3) as $blog)
                <a href="{{ route('blog.detail', ['slug' => $blog->slug]) }}" class="trending-sub-card">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->name }}" onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                    <div class="card-overlay">
                        <span class="card-tag">{{ __('welcome.trending') }}</span>
                        <h5 class="fw-bold mb-0 text-white" style="font-size: 0.95rem; line-height: 1.3;">{{ Str::limit($blog->name, 45) }}</h5>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- 3. Bottom Wide Card (Spans Full Width) -->
            @if($topblogs->count() > 4)
                @php $wideBlog = $topblogs->skip(4)->first(); @endphp
                <a href="{{ route('blog.detail', ['slug' => $wideBlog->slug]) }}" class="trending-wide-card">
                    <img src="{{ $wideBlog->image_url }}" alt="{{ $wideBlog->name }}" onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                    <div class="card-overlay">
                        <span class="card-tag">{{ __('welcome.trending') }}</span>
                        <h3 class="h5 fw-bold mb-0 text-white">{{ Str::limit($wideBlog->name, 70) }}</h3>
                    </div>
                </a>
            @endif
        @else
            <p class="text-muted text-center w-100">{{ __('welcome.no_articles') }}</p>
        @endif
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="btn btn-primary-custom">{{ __('welcome.view_all_blogs') }} <i class="fas fa-arrow-right ms-1"></i></a>
    </div>
</section>

<!-- ======== ENHANCE STATS BAR ======== -->
<section class="container-fluid px-0">
    <div class="stats-wrapper" data-aos="fade-up">
        <div class="container text-center">
            <h3 class="stats-title">
                <span class="text-orange">{{ __('welcome.enhance_experience') }}</span> {{ __('welcome.with_us') }}
            </h3>
            <p class="stats-subtitle">{{ __('welcome.stats_subtitle') }}</p>
            
            <div class="stat-pill-container">
                <div class="stat-pill">
                    <div class="stat-icon"><i class="fas fa-store"></i></div>
                    <div class="stat-pill-text">
                        <h5 class="counter" data-target="{{ $activeStoresCount }}">500+</h5>
                        <span>{{ __('welcome.active_stores') }}</span>
                    </div>
                </div>
                <div class="stat-pill">
                    <div class="stat-icon"><i class="fas fa-ticket-alt"></i></div>
                    <div class="stat-pill-text">
                        <h5 class="counter" data-target="{{ $verifiedCouponsCount }}">10,000+</h5>
                        <span>{{ __('welcome.verified_coupons') }}</span>
                    </div>
                </div>
                <div class="stat-pill">
                    <div class="stat-icon"><i class="fas fa-blog"></i></div>
                    <div class="stat-pill-text">
                        <h5 class="counter" data-target="{{ $totalBlogsCount }}">50+</h5>
                        <span>{{ __('welcome.total_blogs') }}</span>
                    </div>
                </div>
                <div class="stat-pill">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-pill-text">
                        <h5 class="counter" data-target="{{ $totalUsersCount }}">10,0+</h5>
                        <span>{{ __('welcome.happy_members') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======== FEATURED STORES ======== -->
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title mb-0">{{ __('welcome.featured_stores') }}</h2>
        <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="btn btn-primary-custom btn-sm">{{ __('welcome.all_stores') }}</a>
    </div>

    <div class="stores-grid" data-aos="fade-up">
        @forelse($TopStores as $store)
        <a href="{{ route('store.detail', ['slug' => $store->slug]) }}" class="store-card">
            <div class="store-logo-container">
                <img src="{{ $store->image_url }}" alt="{{ $store->name }}" onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
            </div>
            <h6>{{ $store->name }}</h6>
        </a>
        @empty
            <p class="text-muted text-center w-100">{{ __('welcome.no_featured_stores') }}</p>
        @endforelse
    </div>
</section>

<!-- ======== EXPLORE CATEGORIES ======== -->
<section class="container categories-section py-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <h2 class="section-title">{{ __('welcome.explore_categories') }}</h2>
        <p class="text-muted">{{ __('welcome.categories_subtitle') }}</p>
    </div>

    <div class="categories-grid" data-aos="fade-up">
        @forelse($categories as $category)
            <a href="{{ route('category.detail', ['slug' => $category->slug]) ?? '#' }}" class="category-card">
                <div class="category-img-wrapper">
                    <img 
                        src="{{ $category->image_url ?? asset('assets/img/no-image-found.png') }}" 
                        alt="{{ $category->name }}" 
                        class="category-img"
                        loading="lazy"
                        onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'"
                    >
                </div>
                <h6>{{ $category->name }}</h6>
            </a>
        @empty
            <p class="text-muted text-center w-100">{{ __('welcome.no_categories') }}</p>
        @endforelse
    </div>
</section>

<!-- ======== TOP COUPONS ======== -->
<section class="container py-5">
    <div class="text-center mb-4">
        <h2 class="section-title">{{ __('welcome.top_coupons') }}</h2>
        <p class="text-muted">{{ __('welcome.coupons_subtitle') }}</p>
    </div>

    <div class="coupons-grid" data-aos="fade-up">
        @forelse($topCoupons as $coupon)
        <div class="coupon-card">
            <div class="coupon-img-wrapper">
                <img src="{{ optional($coupon->store)->image_url ?? $coupon->stores->image_url ?? '' }}" 
                     alt="{{ optional($coupon->store)->name ?? 'Store' }}"
                     onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
            </div>

            <div class="coupon-meta">
                <div class="verified-badge">
                    <i class="fas fa-check-circle"></i> {{ __('welcome.verified') }}
                </div>
                @if(!empty($coupon->ending_date))
                    <div class="expiry-date">
                        {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d, Y') }}
                    </div>
                @endif
            </div>

            <h5 class="coupon-title">{{ $coupon->name }}</h5>

            <div class="coupon-discount">
                @if($coupon->discount_type === 'percent')
                    {{ $coupon->discount_value }}% OFF
                @elseif($coupon->discount_type === 'flat')
                    {{ $coupon->discount_value }} OFF
                @else
                    {{ $coupon->discount_value }}
                @endif
            </div>

            <div class="coupon-action-wrapper">
                <button class="reveal-btn"
                        data-code="{{ $coupon->code }}"
                        data-store="{{ optional($coupon->store)->name ?? $coupon->stores->name ?? 'Store' }}"
                        data-url="{{ optional($coupon->store)->destination_url ?? $coupon->stores->destination_url ?? '#' }}">
                    {{ __('welcome.reveal_code') }}
                </button>
                <span class="store-name-label">
                    {{ optional($coupon->store)->name ?? $coupon->stores->name ?? 'Unknown Store' }}
                </span>
            </div>
        </div>
        @empty
            <p class="text-muted text-center w-100">{{ __('welcome.no_coupons') }}</p>
        @endforelse
    </div>
</section>

<!-- ======== LATEST ARTICLES ======== -->
<section class="container py-2 bg-light rounded-4">
    <div class="text-center mb-4">
        <h2 class="section-title">{{ __('welcome.latest_articles') }}</h2>
        <p class="text-muted">{{ __('welcome.articles_subtitle') }}</p>
    </div>

    <div class="latest-grid" data-aos="fade-up">
        @forelse($latestblogs as $blog)
        <div class="latest-card">
            <img src="{{ $blog->image_url }}" alt="{{ $blog->name }}" onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
            <div class="latest-card-body">
                <small class="text-muted d-block mb-2"><i class="far fa-calendar me-1"></i> {{ $blog->created_at->format('M d, Y') }}</small>
                <h5>{{ Str::limit($blog->name, 50) }}</h5>
                <p>{{ Str::limit(strip_tags($blog->description), 80) }}</p>
                <a href="{{ route('blog.detail', ['slug' => $blog->slug]) }}">{{ __('welcome.read_more') }} <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
        @empty
            <p class="text-muted text-center w-100">{{ __('welcome.no_articles') }}</p>
        @endforelse
    </div>
</section>

<!-- ======== FAQ SECTION ======== -->
<section class="container faq-section">
    <h2 class="section-title">{{ __('welcome.faq_title') }}</h2>
    
    <div class="accordion" id="faqAccordion" data-aos="fade-up">
        
        <!-- FAQ 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    {{ __('welcome.faq_q1') }}
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                   {{ __('welcome.faq_a1') }}
                </div>
            </div>
        </div>

        <!-- FAQ 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    {{ __('welcome.faq_q2') }}
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {{ __('welcome.faq_a2') }}
                </div>
            </div>
        </div>

        <!-- FAQ 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    {{ __('welcome.faq_q3') }}
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {{ __('welcome.faq_a3') }}
                </div>
            </div>
        </div>

        <!-- FAQ 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    {{ __('welcome.faq_q4') }}
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {{ __('welcome.faq_a4') }}
                </div>
            </div>
        </div>

        <!-- FAQ 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    {{ __('welcome.faq_q5') }}
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {{ __('welcome.faq_a5') }}
                </div>
            </div>
        </div>

        <!-- FAQ 6 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    {{ __('welcome.faq_q6') }}
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {{ __('welcome.faq_a6') }}
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ======== COUPON REVEAL MODAL ======== -->
<div class="modal fade" id="couponRevealModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title"><i class="fas fa-gift me-2"></i> {{ __('welcome.modal_title') }}</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="fw-bold mb-3 text-secondary" id="couponModalStore">Store Name</h6>
                
                <div class="d-flex flex-column gap-3 mb-4">
                    <input type="text" class="form-control text-center" id="couponModalCode" readonly value="CODE123">
                    <button class="btn" id="couponCopyBtn">{{ __('welcome.modal_copy_btn') }}</button>
                </div>
                
                <p class="text-muted small mb-3">{{ __('welcome.modal_copied_text') }}</p>
                
                <a href="#" id="couponModalVisitBtn" class="btn visit-store-btn w-100" target="_blank">
                    {{ __('welcome.modal_visit_btn') }} <i class="fas fa-external-link-alt ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof AOS !== 'undefined') {
                AOS.init({ duration: 800, once: true, offset: 100 });
            }

            // ─── Counter Animation ─────────────────────────
            const counters = document.querySelectorAll('.counter');
            const counterObserver = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    const el = entry.target;
                    const raw = el.textContent.trim();
                    const hasPlus = raw.includes('+');
                    const target = parseInt(raw.replace(/[^\d]/g, ''), 10) || 0;
                    let start = 0;
                    const duration = 1800;
                    const startTime = performance.now();

                    function tick(now) {
                        const p = Math.min((now - startTime) / duration, 1);
                        const eased = 1 - Math.pow(1 - p, 3);
                        el.textContent = Math.floor(target * eased).toLocaleString('en-US') + (hasPlus ? '+' : '');
                        if (p < 1) requestAnimationFrame(tick);
                    }
                    requestAnimationFrame(tick);
                    obs.unobserve(el);
                });
            }, { threshold: 0.4 });
            counters.forEach(c => counterObserver.observe(c));

            // ─── Coupon Reveal Modal Logic ─────────────────
            const modalEl = document.getElementById('couponRevealModal');
            if (modalEl) {
                const modal = new bootstrap.Modal(modalEl);
                const codeInput = document.getElementById('couponModalCode');
                const storeLabel = document.getElementById('couponModalStore');
                const copyBtn = document.getElementById('couponCopyBtn');
                const visitBtn = document.getElementById('couponModalVisitBtn');

                document.querySelectorAll('.reveal-btn').forEach(btn => {
                    btn.addEventListener('click', function (e) {
                        e.preventDefault();
                        
                        const code = this.dataset.code;
                        const store = this.dataset.store;
                        const url = this.dataset.url;

                        // Populate Modal Data
                        codeInput.value = code;
                        storeLabel.textContent = store;
                        visitBtn.href = url;

                        // Reset Copy Button
                        copyBtn.innerHTML = '{{ __('welcome.modal_copy_btn') }}';
                        copyBtn.style.background = 'var(--yellow-gradient)';
                        copyBtn.style.color = 'var(--text-on-yellow)';

                        // Show Modal
                        modal.show();

                        // Auto-copy to clipboard on open
                        copyToClipboard(code, copyBtn);
                    });
                });

                // Copy button inside modal
                copyBtn.addEventListener('click', function () {
                    copyToClipboard(codeInput.value, copyBtn);
                });
            }

            // Helper: Copy to clipboard
            function copyToClipboard(text, button) {
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(text).then(() => {
                        showCopiedState(button);
                    }).catch(err => {
                        console.error('Failed to copy: ', err);
                    });
                } else {
                    // Fallback
                    const textArea = document.createElement("textarea");
                    textArea.value = text;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
                    showCopiedState(button);
                }
            }

            // Helper: Show Copied Feedback
            function showCopiedState(button) {
                button.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
                button.style.background = '#10b981'; // Green
                button.style.color = '#ffffff';
                
                setTimeout(() => {
                    button.innerHTML = '{{ __('welcome.modal_copy_btn') }}';
                    button.style.background = 'var(--yellow-gradient)';
                    button.style.color = 'var(--text-on-yellow)';
                }, 3000);
            }
        });
    </script>
@endpush