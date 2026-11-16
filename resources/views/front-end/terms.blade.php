@extends('layouts.master')

@section('title', __('terms.meta_title', ['app' => config('app.name')]))
@section('description', __('terms.meta_description'))
@section('keywords', __('terms.meta_keywords'))
@section('author', __('terms.meta_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/terms.css') }}">
@endpush

@section('content')
<!-- Terms Header -->
<div class="terms-header">
    <div class="container text-center">
        <h1>{{ __('terms.header_title') }}</h1>
        <p class="lead">{{ __('terms.header_subtitle') }}</p>
        <div class="last-updated-badge">
            <i class="fas fa-history me-2"></i>{{ __('terms.last_updated', ['date' => date('F j, Y')]) }}
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <div class="terms-card">
                <!-- Trademark Disclaimer Alert -->
                <div class="trademark-alert">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ __('terms.trademark_disclaimer') }}
                </div>

                <div class="terms-content">
                    <!-- Section 1 -->
                    <section class="terms-section">
                        <h2>{{ __('terms.sec_1_title') }}</h2>
                        <p>{{ __('terms.sec_1_text', ['app' => config('app.name')]) }}</p>
                    </section>

                    <!-- Section 2 -->
                    <section class="terms-section">
                        <h2>{{ __('terms.sec_2_title') }}</h2>
                        <p>{{ __('terms.sec_2_text', ['app' => config('app.name')]) }}</p>
                    </section>

                    <!-- Section 3 -->
                    <section class="terms-section">
                        <h2>{{ __('terms.sec_3_title') }}</h2>
                        <p>{{ __('terms.sec_3_text') }}</p>
                        <ul class="terms-list">
                            @foreach(__('terms.sec_3_items') as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </section>

                    <!-- Section 4 -->
                    <section class="terms-section">
                        <h2>{{ __('terms.sec_4_title') }}</h2>
                        <p>{{ __('terms.sec_4_text', ['app' => config('app.name')]) }}</p>
                    </section>

                    <!-- Section 5 -->
                    <section class="terms-section">
                        <h2>{{ __('terms.sec_5_title') }}</h2>
                        <p>{{ __('terms.sec_5_text', ['app' => config('app.name')]) }}</p>
                    </section>

                    <!-- Section 6 -->
                    <section class="terms-section">
                        <h2>{{ __('terms.sec_6_title') }}</h2>
                        <p>{{ __('terms.sec_6_text') }}</p>
                    </section>

                    <!-- Section 7 -->
                    <section class="terms-section">
                        <h2>{{ __('terms.sec_7_title') }}</h2>
                        <p>{{ __('terms.sec_7_text') }}</p>
                    </section>

                    <!-- Section 8 -->
                    <section class="terms-section">
                        <h2>{{ __('terms.sec_8_title') }}</h2>
                        <p>{{ __('terms.sec_8_text') }}</p>
                    </section>

                    <!-- Section 9 (Contact) -->
                    <section class="terms-section border-0 mb-0 pb-0">
                        <h2>{{ __('terms.sec_9_title') }}</h2>
                        <p>{{ __('terms.sec_9_text') }}</p>
                        
                        <a href="{{ route('contact', ['lang' => app()->getLocale()]) }}" class="btn-contact">
                            <i class="fas fa-envelope me-2"></i>{{ __('terms.sec_9_btn') }}
                        </a>
                    </section>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection