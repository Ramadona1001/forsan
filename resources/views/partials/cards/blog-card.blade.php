<div class="card blog-card h-100 shadow-sm">
    <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none">
        <img src="{{ $blog->getFirstMediaUrl('featured_image') ?: 'https://via.placeholder.com/600x400' }}"
            class="card-img-top" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}">
    </a>

    <div class="card-body">
        @if($blog->category)
            <span class="badge bg-primary mb-2">{{ $blog->category->getTranslation('name', app()->getLocale()) }}</span>
        @endif

        <h5 class="card-title">
            <a href="{{ route('blogs.show', $blog->slug) }}" class="text-dark text-decoration-none">
                {{ $blog->getTranslation('title', app()->getLocale()) }}
            </a>
        </h5>

        <p class="card-text text-muted small">
            {{ Str::limit($blog->getTranslation('excerpt', app()->getLocale()), 100) }}
        </p>
    </div>

    <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
        <small class="text-muted">
            <i class="bi bi-person me-1"></i>{{ $blog->author?->name }}
        </small>
        <small class="text-muted">
            <i class="bi bi-calendar me-1"></i>{{ $blog->published_at?->format('Y-m-d') }}
        </small>
    </div>
</div>