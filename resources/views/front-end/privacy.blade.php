@extends('layouts.master')

@section('title', __('privacy.meta_title', ['app' => config('app.name')]))
@section('description', __('privacy.meta_description'))
@section('keywords', __('privacy.meta_keywords'))
@section('author', __('privacy.meta_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/privacy.css') }}">
@endpush

@section('content')
<!-- Privacy Header -->
<div class="privacy-header">
    <div class="container text-center">
        <h1>{{ __('privacy.header_title') }}</h1>
        <p class="lead">{{ __('privacy.header_subtitle') }}</p>
        <div class="last-updated-badge">
            <i class="fas fa-history me-2"></i>{{ __('privacy.last_updated', ['date' => now()->format('F d, Y')]) }}
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <div class="privacy-card">
                <div class="privacy-content">
                    
                    <!-- 1. Introduction -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_1_title') }}</h2>
                        <p>{{ __('privacy.sec_1_text', ['app' => config('app.name')]) }}</p>
                    </section>

                    <!-- 2. Information We Collect -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_2_title') }}</h2>
                        <ul class="privacy-list">
                            @foreach(__('privacy.sec_2_items') as $item)
                                <li>{!! $item !!}</li>
                            @endforeach
                        </ul>
                    </section>

                    <!-- 3. How We Use Your Information -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_3_title') }}</h2>
                        <p>{{ __('privacy.sec_3_text') }}</p>
                        <ul class="privacy-list">
                            @foreach(__('privacy.sec_3_items') as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </section>

                    <!-- 4. Cookies & Tracking -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_4_title') }}</h2>
                        <p>{{ __('privacy.sec_4_text') }}</p>
                    </section>

                    <!-- 5. Third-Party Services -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_5_title') }}</h2>
                        <p>{{ __('privacy.sec_5_text', ['app' => config('app.name')]) }}</p>
                    </section>

                    <!-- 6. Data Protection -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_6_title') }}</h2>
                        <p>{{ __('privacy.sec_6_text') }}</p>
                    </section>

                    <!-- 7. Your Rights -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_7_title') }}</h2>
                        <p>{{ __('privacy.sec_7_text') }}</p>
                    </section>

                    <!-- 8. Children’s Privacy -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_8_title') }}</h2>
                        <p>{{ __('privacy.sec_8_text') }}</p>
                    </section>

                    <!-- 9. Disclaimer -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_9_title') }}</h2>
                        <p>{{ __('privacy.sec_9_text', ['app' => config('app.name')]) }}</p>
                    </section>

                    <!-- 10. Changes to This Policy -->
                    <section class="privacy-section">
                        <h2>{{ __('privacy.sec_10_title') }}</h2>
                        <p>{{ __('privacy.sec_10_text') }}</p>
                    </section>

                    <!-- 11. Contact Us -->
                    <section class="privacy-section border-0 mb-0 pb-0">
                        <h2>{{ __('privacy.sec_11_title') }}</h2>
                        <p>{{ __('privacy.sec_11_text') }}</p>
                        
                        <a href="{{ route('contact', ['lang' => app()->getLocale()]) }}" class="btn-contact">
                            <i class="fas fa-envelope me-2"></i>{{ __('privacy.contact_btn') }}
                        </a>
                    </section>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth fade in for sections
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.privacy-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(section);
        });
    });
</script>
@endpush