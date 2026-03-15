@extends('frontend.homepage.layout')
@section('header-class', 'header-inner')

@section('content')

    @php
        $postLang = $post->languages->first()?->pivot;
        $postTitle = $postLang?->name ?? ($post->name ?? '');
        $postDesc = $postLang?->description ?? '';
        $postImage = $post->image ?? asset('images/placeholder-news.jpg');

        $postDate = $post->released_at
            ? \Carbon\Carbon::parse($post->released_at)
            : \Carbon\Carbon::parse($post->created_at);
        $dateFormatted = $postDate->format('F d, Y');

        $catLang = $postCatalogue->languages->first()?->pivot ?? null;
        $catName = $catLang?->name ?? ($postCatalogue->name ?? 'Bài viết');
        $catUrl = $catLang?->canonical ?? ($postCatalogue->canonical ?? '#');
    @endphp

    <div id="scroll-progress"></div>
    <div class="linden-page">

        <section
            class="uk-cover-background uk-position-relative uk-block-large uk-contrast hp-hero-breadcrumb-premium-section"
            style="background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}');">
            <div class="hp-hero-overlay-blur"></div>
            <div class="uk-container uk-container-center uk-position-relative hp-z-10">
                <div class="uk-flex uk-flex-middle uk-flex-center uk-height-1-1">
                    <div class="uk-width-1-1 uk-text-center">
                        <h1 class="hp-hero-title-premium uk-margin-small-bottom" data-reveal="up">
                            Chi tiết bài viết
                        </h1>
                        <ul class="uk-breadcrumb uk-flex-center hp-breadcrumb-premium" data-reveal="up">
                            <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                            <li class="hp-sep"><i class="fa fa-angle-right"></i></li>
                            <li><a href="{{ write_url($postCatalogue->languages->first()->pivot->canonical) }}">{{ $postCatalogue->languages->first()->pivot->name }}</a></li>
                            <li class="hp-sep"><i class="fa fa-angle-right"></i></li>
                            <li class="uk-active"><span>Chi tiết</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="hp-section bg-white hp-section-padding">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-large" data-uk-grid-margin>
                    <!-- Main Content (8) -->
                    <div class="uk-width-large-2-3">
                        <article class="hp-post-detail">
                            <div class="hp-post-detail__header" data-reveal="up">
                                <h1 class="hp-post-detail__title">{{ $postTitle }}</h1>

                                <div class="hp-post-detail__meta">
                                    <div class="hp-post-detail__meta-item">
                                        <i class="fa fa-calendar-o"></i>
                                        @php
                                            \Carbon\Carbon::setLocale('vi');
                                            $dateVi = $postDate->translatedFormat('d \T\h\á\n\g m, Y');
                                        @endphp
                                        <span>{{ $dateVi }}</span>
                                    </div>
                                    <div class="hp-post-detail__meta-item">
                                        <i class="fa fa-folder-open-o"></i>
                                        <span>{{ $catName }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="hp-post-detail__img" data-reveal="up">
                                <img src="{{ asset($postImage) }}" alt="{{ $postTitle }}">
                            </div>

                            <div class="hp-post-detail__content hp-content-entry" data-reveal="up">
                                {!! $contentWithToc ?? $postLang?->content !!}
                            </div>
                        </article>
                    </div>

                    <!-- Sidebar (4) -->
                    <div class="uk-width-large-1-3">
                        <aside class="hp-sidebar">
                            <!-- Search -->
                            <div class="hp-sidebar-widget">
                                <h4 class="hp-sidebar-title">Tìm kiếm</h4>
                                <form
                                    action="{{ route('post.catalogue.index', ['canonical' => $postCatalogue->canonical]) }}"
                                    method="GET" class="hp-sidebar-search">
                                    <input type="text" name="keyword" placeholder="Nhập từ khóa...">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>

                            <!-- Related Posts -->
                            @if (isset($postCatalogue->posts) && $postCatalogue->posts->where('id', '!=', $post->id)->count() > 0)
                                <div class="hp-sidebar-widget">
                                    <h4 class="hp-sidebar-title">Bài viết liên quan</h4>
                                    <div class="hp-sidebar-post-list">
                                        @foreach ($postCatalogue->posts->where('id', '!=', $post->id)->take(5) as $relatedPost)
                                            @php
                                                $lLang = $relatedPost->languages->first()?->pivot;
                                                $lTitle = $lLang?->name ?? $relatedPost->name;
                                                $lUrl = write_url($lLang?->canonical ?? '#');
                                                $lImg = !empty($relatedPost->image)
                                                    ? asset($relatedPost->image)
                                                    : asset('frontend/resources/img/homely/gallery/1.webp');
                                                $lDate = !empty($relatedPost->released_at)
                                                    ? \Carbon\Carbon::parse($relatedPost->released_at)
                                                    : \Carbon\Carbon::parse($relatedPost->created_at);
                                            @endphp
                                            <div class="hp-sidebar-post-item">
                                                <div class="hp-sidebar-post-thumb">
                                                    <a href="{{ $lUrl }}">
                                                        <img src="{{ $lImg }}" alt="{{ $lTitle }}">
                                                    </a>
                                                </div>
                                                <div class="hp-sidebar-post-info">
                                                    <h5 class="hp-sidebar-post-title">
                                                        <a href="{{ $lUrl }}">{{ Str::limit($lTitle, 45) }}</a>
                                                    </h5>
                                                    <span
                                                        class="hp-sidebar-post-date">{{ $lDate->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </aside>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
