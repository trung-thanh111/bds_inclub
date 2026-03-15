@extends('frontend.homepage.layout')

@section('header-class', 'header-inner')
@section('content')
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
                            @if (isset($postCatalogue) && $postCatalogue && $postCatalogue->parent_id != 0)
                                {{ $postCatalogue->languages->first()->pivot->name ?? 'Bài viết' }}
                            @else
                                Bài Viết
                            @endif
                        </h1>
                        <ul class="uk-breadcrumb uk-flex-center hp-breadcrumb-premium" data-reveal="up">
                            <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                            <li class="hp-sep"><i class="fa fa-angle-right"></i></li>
                            <li class="uk-active">
                                <span>
                                    @if (isset($postCatalogue) && $postCatalogue && $postCatalogue->parent_id != 0)
                                        {{ $postCatalogue->languages->first()->pivot->name ?? 'Tin tức' }}
                                    @else
                                        Tin tức
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="hp-section bg-white hp-section-padding">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-large" data-uk-grid-margin>
                    <div class="uk-width-large-2-3">
                        @if (!empty($posts) && $posts->count() > 0)
                            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                                @foreach ($posts as $index => $post)
                                    @php
                                        $postImage = !empty($post->image)
                                            ? asset($post->image)
                                            : asset('images/placeholder-news.jpg');
                                        $postUrl = !empty($post->canonical)
                                            ? url(
                                                rtrim($post->canonical, '/') .
                                                    (str_ends_with($post->canonical, '.html') ? '' : '.html'),
                                            )
                                            : '#';
                                        $postName = $post->name ?? 'Untitled';
                                        $publishedAt = !empty($post->released_at)
                                            ? \Carbon\Carbon::parse($post->released_at)
                                            : \Carbon\Carbon::parse($post->created_at);

                                        \Carbon\Carbon::setLocale('vi');
                                        $dateFormatted = $publishedAt->translatedFormat('d \T\h\á\n\g m, Y');

                                        $categoryName = '';
                                        if ($post->post_catalogues->count() > 0) {
                                            $cat = $post->post_catalogues->first();
                                            $categoryName = $cat->languages->first()->pivot->name ?? '';
                                        }
                                    @endphp
                                    <div class="uk-width-medium-1-2 uk-margin-bottom">
                                        <article class="hp-post-card" data-reveal="up">
                                            <div class="hp-post-card__img">
                                                <a href="{{ $postUrl }}">
                                                    <img src="{{ $postImage }}" alt="{{ $postName }}">
                                                </a>
                                            </div>
                                            <div class="hp-post-card__body">
                                                <div class="hp-post-card__meta">
                                                    {{ $dateFormatted }}
                                                </div>
                                                <h3 class="hp-post-card__title">
                                                    <a href="{{ $postUrl }}">{{ Str::limit($postName, 60) }}</a>
                                                </h3>
                                                <p class="hp-post-card__excerpt">
                                                    {{ Str::limit(html_entity_decode(strip_tags($post->description ?? '')), 100) }}
                                                </p>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>

                            @if ($posts->hasPages())
                                <div class="uk-margin-large-top uk-text-center">
                                    {{ $posts->links('frontend.component.pagination') }}
                                </div>
                            @endif
                        @else
                            <div class="hp-empty-state uk-text-center">
                                <p>Không tìm thấy bài viết nào trong chuyên mục này.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar (4) -->
                    <div class="uk-width-large-1-3">
                        <aside class="hp-sidebar">
                            <!-- Search -->
                            <div class="hp-sidebar-widget">
                                <h4 class="hp-sidebar-title">Tìm kiếm</h4>
                                <form action="{{ request()->url() }}" method="GET" class="hp-sidebar-search">
                                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                                        placeholder="Nhập từ khóa...">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
