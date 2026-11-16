@extends('layouts.master')

@section('title', __('blog.meta_title', ['year' => date('Y'), 'app' => config('app.name')]))
@section('description', __('blog.meta_description', ['year' => date('Y'), 'app' => config('app.name')]))
@section('keywords', __('blog.meta_keywords'))
@section('author', __('blog.meta_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="header-bg-animation"></div>
    <div class="container text-center position-relative z-1">
        <h1>{{ __('blog.page_title') }}</h1>
        <p class="lead">#YourShortcutToSavings</p>
    </div>
</div>

<nav class="breadcrumb-nav" aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item">
                <a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>{{ __('common.home') }}
                </a>
            </li>
            <li class="breadcrumb-item active d-flex align-items-center" aria-current="page">
                <span class="mx-2 text-muted">
                    <i class="fas fa-chevron-right small"></i>
                </span>
                <i class="fas fa-store me-2 text-primary"></i>
                {{ __('common.stores') }}
            </li>
        </ol>
    </div>
</nav>

<div class="container py-5">
    <!-- Trending Blogs Section -->
    @if($trendingBlogs->count() > 0)
    <div class="trending-section text-center mb-5">
        <div class="trending-blob-badge">
            <span class="tb-title">TRENDING BLOGS</span>
            <span class="tb-subtitle">By Coupon Thunder</span>
        </div>
        
        <div class="trending-grid mt-4 text-start">
            @if(isset($trendingBlogs[0]))
            <a href="{{ route('blog.detail', ['slug' => ($trendingBlogs[0]->slug)]) }}" class="trending-main-card">
                <img src="{{ $trendingBlogs[0]->image_url }}" alt="{{ $trendingBlogs[0]->name }}">
                <div class="card-overlay">
                    <span class="card-tag">{{ $trendingBlogs[0]->category->name ?? 'FEATURED' }}</span>
                    <h3 class="h4 fw-bold mb-0 text-white">{{ $trendingBlogs[0]->name }}</h3>
                </div>
            </a>
            @endif

            <div class="trending-sub-grid">
                @foreach($trendingBlogs->skip(1)->take(3) as $blog)
                <a href="{{ route('blog.detail', ['slug' => ($blog->slug)]) }}" class="trending-sub-card">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->name }}">
                    <div class="card-overlay">
                        <span class="card-tag">{{ $blog->category->name ?? 'TRENDING' }}</span>
                        <h5 class="fw-bold mb-0 text-white" style="font-size: 1rem; line-height: 1.3;">{{ Str::limit($blog->name, 45) }}</h5>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Title & Dynamic Filter Pills -->
    <div class="blogs-section-header text-center mt-5 mb-4">
        <h2 class="section-title">Our Blogs</h2>
        
        <div class="category-filters">
            <a href="{{ url()->current() }}" class="filter-pill {{ $activeCategory == 'all' ? 'active' : '' }}">
                All <span>({{ $totalBlogs }})</span>
            </a>
            @foreach($categories as $category)
                @if($category->blogs_count > 0)
                <a href="{{ url()->current() }}?category={{ $category->slug }}" 
                   class="filter-pill {{ $activeCategory == $category->slug ? 'active' : '' }}">
                    {{ $category->name }} <span>({{ $category->blogs_count }})</span>
                </a>
                @endif
            @endforeach
        </div>
    </div>

    <!-- NEW: AJAX Blog Grid Wrapper -->
    <div id="blog-results-container" style="transition: opacity 0.3s ease;">
        @include('front-end.partials.blogs_list')
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image error fallback for dynamically loaded content
        function bindImageErrors() {
            document.querySelectorAll('.card-img-top').forEach(img => {
                img.addEventListener('error', function() {
                    this.src = '{{ asset("assets/img/no-image-found.png") }}';
                });
            });
        }
        bindImageErrors();

        // AJAX fetch function
        function loadBlogs(url) {
            const container = document.getElementById('blog-results-container');
            container.style.opacity = '0.5'; // Fade out slightly while loading

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Tell Laravel it's an AJAX request
                }
            })
            .then(res => res.json())
            .then(data => {
                container.innerHTML = data.html;
                container.style.opacity = '1';
                window.history.pushState({}, '', url); // Update URL without reloading
                bindImageErrors(); // Rebind to new images
            })
            .catch(err => {
                console.error('Error loading blogs:', err);
                container.style.opacity = '1';
            });
        }

        // Handle Category Pill Clicks
        document.querySelectorAll('.filter-pill').forEach(pill => {
            pill.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                if (!url) return;

                // Update active state
                document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
                this.classList.add('active');

                loadBlogs(url);
            });
        });

        // Handle Pagination Clicks (Event Delegation)
        document.addEventListener('click', function(e) {
            const paginationLink = e.target.closest('#pagination-wrapper a');
            if (paginationLink) {
                e.preventDefault();
                loadBlogs(paginationLink.getAttribute('href'));
            }
        });
        
        // Handle "View All Blogs" button inside no results
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('filter-pill-reset')) {
                e.preventDefault();
                const url = e.target.getAttribute('href');
                loadBlogs(url);
                
                // Reset active pills
                document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
                document.querySelector('.filter-pill').classList.add('active'); 
            }
        });
    });
</script>
@endpush