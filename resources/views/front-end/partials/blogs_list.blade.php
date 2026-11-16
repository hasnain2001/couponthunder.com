<!-- resources/views/front-end/partials/_blogs_list.blade.php -->
<div class="row g-4">
    @forelse ($blogs as $blog)
    <div class="col-12 col-md-6 col-lg-4">
        <div class="blog-card h-100">
            <a href="{{ route('blog.detail', ['slug' => ($blog->slug)]) }}" class="text-decoration-none d-flex flex-column h-100">
                <div class="position-relative overflow-hidden card-img-wrapper">
                    <img
                        src="{{ $blog->image ? $blog->image_url : asset('assets/img/no-image-found.png') }}"
                        alt="{{ $blog->name }}"
                        class="card-img-top"
                        loading="lazy"
                        onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'"
                    >
                </div>
                <div class="card-body d-flex flex-column">
                    <span class="card-category">{{ $blog->category->name ?? 'GENERAL' }}</span>
                    <h5 class="card-title">{{ $blog->name }}</h5>
                    <div class="card-date mt-auto">
                        {{ $blog->created_at->format('F d, Y') }}
                    </div>
                </div>
            </a>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <h4 class="text-muted">No blogs found in this category.</h4>
        <a href="{{ url()->current() }}" class="btn btn-primary mt-3 filter-pill-reset">View All Blogs</a>
    </div>
    @endforelse
</div>

@if ($blogs->hasPages())
<div class="d-flex justify-content-center mt-5" id="pagination-wrapper">
    {{ $blogs->links('pagination::bootstrap-5') }}
</div>
@endif
 