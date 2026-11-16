@extends('admin.layouts.app')
@section('title', 'Show Slider')
@push('styles')
    <style>
        .badge {
            font-size: 0.875em;
        }
        .slider-thumb {
            width: 100%;
            max-height: 320px;
            object-fit: cover;
            border-radius: .5rem;
            box-shadow: 0 .125rem .5rem rgba(0, 0, 0, .075);
        }
        .detail-label {
            width: 32%;
            color: #6c757d;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }
    </style>
@endpush
@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Slider Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.slider.index') }}" class="text-decoration-none">Sliders</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $slider->title }}</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.slider.index') }}" class="btn btn-outline-secondary">
                <i class="mdi mdi-arrow-left me-1"></i> Back to Sliders
            </a>
            <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-primary">
                <i class="mdi mdi-pencil me-1"></i> Edit Slider
            </a>
        </div>
    </div>

    <div class="row g-4">

        {{-- Image Preview --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h6 class="card-title text-uppercase text-muted fw-bold small mb-0">
                        <i class="mdi mdi-image-outline me-1"></i> Preview
                    </h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" class="slider-thumb">
                    <div class="mt-3">
                        <span class="badge rounded-pill px-3 py-2 {{ $slider->status ? 'bg-success' : 'bg-secondary' }}">
                            <i class="mdi {{ $slider->status ? 'mdi-check-circle-outline' : 'mdi-close-circle-outline' }} me-1"></i>
                            {{ $slider->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Details --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h6 class="card-title text-uppercase text-muted fw-bold small mb-0">
                        <i class="mdi mdi-information-outline me-1"></i> Slider Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="detail-label">Title</th>
                                    <td class="fw-semibold">{{ $slider->title }}</td>
                                </tr>
                                <tr>
                                    <th class="detail-label">Subtitle</th>
                                    <td class="text-muted">{{ $slider->subtitle }}</td>
                                </tr>
                                <tr>
                                    <th class="detail-label">Store</th>
                                    <td>
                                        <span class="badge bg-secondary rounded-pill px-3 py-2">
                                            <i class="mdi mdi-storefront-outline me-1"></i>
                                            {{ $slider->store->name ?? 'No Store' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="detail-label">Language</th>
                                    <td>
                                        <span class="badge rounded-pill px-3 py-2"
                                              style="background-color: {{ $slider->language->color ?? '#6c757d' }}; color: white;">
                                            <i class="mdi mdi-translate me-1"></i>
                                            {{ $slider->language->name }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="detail-label">Link</th>
                                    <td>
                                        <a href="{{ $slider->link }}" target="_blank" class="text-decoration-none">
                                            {{ $slider->link }}
                                            <i class="mdi mdi-open-in-new ms-1 small"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="detail-label">Status</th>
                                    <td>
                                        <span class="badge rounded-pill px-3 py-2 {{ $slider->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $slider->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="detail-label">Sort Order</th>
                                    <td>
                                        <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                            <i class="mdi mdi-sort-numeric me-1"></i>
                                            {{ $slider->sort_order }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="detail-label">Created By</th>
                                    <td>
                                        <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                            <i class="mdi mdi-account me-1"></i>
                                            {{ $slider->user->name  ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="detail-label">Updated By</th>
                                    <td>
                                        <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                            <i class="mdi mdi-account me-1"></i>
                                            {{ $slider->updatedUser->name  ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="detail-label">Button Text</th>
                                    <td>
                                        <span class="badge bg-primary rounded-pill px-3 py-2">
                                            {{ $slider->button_text ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        // You can add any JavaScript specific to this page here
    </script>
@endpush