@extends('layouts.app')

@section('content')
    <section class="main-section blog-details">
      <div class="container">
        <!-- start breadcrumb-->
        <nav class="breadcrumb-parent" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">{{ __('general.blogs') }}</a></li>
            <li class="breadcrumb-item active">{{ $blog->getTranslation('title', app()->getLocale()) }}</li>
          </ol>
        </nav>
        <!-- end breadcrumb-->
        <div class="blog-details__img bordered">
            <img class="img-fluid" src="{{ $blog->getFirstMediaUrl('featured_image') ?: asset('images/default.webp') }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}">
        </div>
        <div class="blog-details__header">
          <h3 class="blog-details__title">{{ $blog->getTranslation('title', app()->getLocale()) }}</h3>
          <h3 class="blog-details__header__date">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</h3>
        </div>
        <div class="blog-details__content">
            {!! $blog->getTranslation('content', app()->getLocale()) !!}
        </div>
      </div>
    </section>
    <!-- end blog-details -->

    <!-- start related Blogs-->
    @if($relatedBlogs->count() > 0)
    <section class="main-section blogs">
      <div class="container">
        <div class="main-section__header">
          <h3 class="section-head line text-center">{{ __('general.related_posts') }}</h3>
        </div>
        <div class="main-section__wrapper">
          <div class="owl-carousel owl-theme blogs--carousel">
            @foreach($relatedBlogs as $relatedBlog)
            <div class="item">
              <div class="third-card">
                <div class="third-card__img">
                    <img class="product-img img-fluid" src="{{ $relatedBlog->getFirstMediaUrl('featured_image') ?: asset('images/default.webp') }}" alt="{{ $relatedBlog->getTranslation('title', app()->getLocale()) }}">
                </div>
                <div class="third-card__content">
                  <h3 class="third-card__name">{{ $relatedBlog->getTranslation('title', app()->getLocale()) }}</h3>
                  <p class="third-card__date">{{ $relatedBlog->published_at ? $relatedBlog->published_at->format('d/m/Y') : $relatedBlog->created_at->format('d/m/Y') }} </p>
                  <p class="third-card__description">{{ Str::limit(strip_tags($relatedBlog->getTranslation('excerpt', app()->getLocale()) ?: $relatedBlog->getTranslation('content', app()->getLocale())), 100) }}</p>
                  <a class="main-button main-primary fill" href="{{ route('blogs.show', $relatedBlog->slug) }}">{{ __('general.read_more') }}</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="custom-buttons">
            <button class="custom-button-next"></button>
            <button class="custom-button-prev"> </button>
          </div>
        </div>
      </div>
    </section>
    @endif
    <!-- end related Blogs-->
@endsection