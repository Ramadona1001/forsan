@extends('layouts.app')

@section('content')
    <!-- start Blogs-->
    <section class="main-section blogs">
      <div class="container">
        <!-- start breadcrumb-->
        <nav class="breadcrumb-parent" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('general.blog') }}</li>
          </ol>
        </nav>
        <!-- end breadcrumb-->
        <div class="row">
          @if($blogs->count() > 0)
            @foreach($blogs as $blog)
            <div class="col-md-6">
              <div class="third-card">
                <div class="third-card__img">
                    <img class="product-img img-fluid" src="{{ $blog->getFirstMediaUrl('featured_image') ?: asset('images/default.webp') }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}">
                </div>
                <div class="third-card__content">
                  <h3 class="third-card__name">{{ $blog->getTranslation('title', app()->getLocale()) }}</h3>
                  <p class="third-card__date">{{ $blog->published_at ? $blog->published_at->format('d/m/Y') : $blog->created_at->format('d/m/Y') }} </p>
                  <p class="third-card__description">{{ Str::limit(strip_tags($blog->getTranslation('excerpt', app()->getLocale()) ?: $blog->getTranslation('content', app()->getLocale())), 100) }}</p>
                  <a class="main-button main-primary fill" href="{{ route('blogs.show', $blog->slug) }}">{{ __('general.read_more') }}</a>
                </div>
              </div>
            </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{ $blogs->links('vendor.pagination.custom') }}
            </div>
          @else
            <div class="col-12">
                <div class="alert alert-info text-center">
                    {{ __('general.no_blogs') }}
                </div>
            </div>
          @endif
        </div>
      </div>
    </section>
    <!-- end Blogs-->
@endsection