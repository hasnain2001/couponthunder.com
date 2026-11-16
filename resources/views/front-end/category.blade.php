@extends('layouts.master')

@section('title', __('categories.meta_title', ['year' => date('Y')]))
@section('description', __('categories.meta_description'))
@section('keywords', __('categories.meta_keywords'))
@section('author', __('categories.meta_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/categories.css') }}">
@endpush

@section('content')
<main class="categories-page">
    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">{{ __('categories.page_title', ['default' => 'All Categories']) }}</h1>
            <p class="page-subtitle">{{ __('categories.page_subtitle', ['default' => 'Find the best deals from your favorite categories']) }}</p>
        </div>
    </header>

    <!-- Categories Grid -->
    <div class="container py-5">
        <div class="categories-grid">
            @forelse ($categories as $category)
                <a href="{{ route('category.detail', ['slug' => $category->slug]) }}" class="category-card">
                    <div class="icon-circle">
                        <!-- Category Image -->
                        <img 
                            src="{{ $category->image_url ?? asset('assets/img/no-image-found.png') }}" 
                            alt="{{ $category->name }}" 
                            class="category-img"
                            loading="lazy"
                            onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'"
                        >
                    </div>
                    <h3 class="category-name">{{ $category->name }}</h3>
                </a>
            @empty
                <div class="col-12 text-center w-100 py-5">
                    <p class="text-muted">No categories found.</p>
                </div>
            @endforelse
        </div>
    </div>
</main>
@endsection