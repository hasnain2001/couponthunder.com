@extends('layouts.master')

@section('title', __('about.meta_title', ['app' => config('app.name')]))
@section('description', __('about.meta_description'))
@section('keywords', __('about.meta_keywords'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush

@section('content')
<!-- About Header -->
<div class="about-header">
    <div class="container">
        <div class="about-header-content">
            <h1>{{ __('about.header_title') }}</h1>
            <p class="lead">{{ __('about.header_subtitle') }}</p>
        </div>
    </div>
</div>

<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item">
                <a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>{{ __('about.breadcrumb_home') }}
                </a>
            </li>
            <li class="breadcrumb-item active text-secondary" aria-current="page">{{ __('about.breadcrumb_about') }}</li>
        </ol>
    </nav>

    <!-- Main Content Card -->
    <div class="about-content-card">
        
        <section class="about-section">
            <h2>{{ __('about.story_title') }}</h2>
            <p>{{ __('about.story_text') }}</p>
        </section>

        <section class="about-section">
            <h2>{{ __('about.mission_title') }}</h2>
            <p>{{ __('about.mission_text') }}</p>
        </section>

        <section class="about-section">
            <h2>{{ __('about.what_we_do_title') }}</h2>
            <ul class="about-list">
                @foreach(__('about.what_we_do_items') as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </section>

        <section class="about-section">
            <h2>{{ __('about.why_choose_title') }}</h2>
            <p>{{ __('about.why_choose_text') }}</p>
        </section>

        <section class="about-section">
            <h2>{{ __('about.team_title') }}</h2>
            <p>{{ __('about.team_text') }}</p>
        </section>

        <section class="about-section">
            <h2>{{ __('about.looking_ahead_title') }}</h2>
            <p>{{ __('about.looking_ahead_text') }}</p>
        </section>

        <section class="about-section">
            <h2>{{ __('about.join_journey_title') }}</h2>
            <p>{{ __('about.join_journey_text') }}</p>
        </section>

        <!-- Your Story Awaits -->
        <section class="about-section border-0 pb-0">
            <h2>{{ __('about.story_heading') }}</h2>
            <p>{{ __('about.story_text') }}</p>
            
            <div class="testimonial-block">
                <p>{!! __('about.testimonial') !!}</p>
            </div>
        </section>

        <!-- CTA Section -->
        <div class="cta-section mt-5">
            <h3>{{ __('about.cta_title') }}</h3>
            <p>{{ __('about.cta_text') }}</p>
            
            <div class="cta-buttons">
                <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="cta-btn primary">
                    <i class="fas fa-store me-2"></i>{{ __('about.cta_primary') }}
                </a>
                <a href="{{ route('coupons', ['lang' => app()->getLocale()]) }}" class="cta-btn secondary">
                    <i class="fas fa-gift me-2"></i>{{ __('about.cta_secondary') }}
                </a>
            </div>
            
            <p class="mt-3 text-muted" style="font-size: 0.9rem;">
                {!! __('about.cta_ps') !!}
            </p>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add ripple effect to CTA buttons
        const buttons = document.querySelectorAll('.cta-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            .ripple {
                position: absolute;
                background: rgba(255, 255, 255, 0.4);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
                z-index: 1;
            }
            
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .cta-btn {
                position: relative;
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endpush