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
                            Thư viện ảnh
                        </h1>
                        <ul class="uk-breadcrumb uk-flex-center hp-breadcrumb-premium" data-reveal="up">
                            <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                            <li class="hp-sep"><i class="fa fa-angle-right"></i></li>
                            <li class="uk-active"><span>Thư viện ảnh</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-gallery-page">
            <div class="uk-container uk-container-center">
                @php
                    $allImages = collect();
                    $catalogueImages = [];

                    if (isset($galleryCatalogues) && $galleryCatalogues->count() > 0) {
                        foreach ($galleryCatalogues as $catalogue) {
                            $catName = $catalogue->languages->first()->pivot->name ?? 'Không tên';
                            $catalogueImages[$catName] = collect();

                            if ($catalogue->galleries->count() > 0) {
                                foreach ($catalogue->galleries as $gallery) {
                                    if (is_array($gallery->album)) {
                                        foreach ($gallery->album as $img) {
                                            $catalogueImages[$catName]->push(['url' => $img, 'name' => $catName]);
                                            $allImages->push(['url' => $img, 'name' => $catName]);
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($galleries->count() > 0) {
                            foreach ($galleries as $gallery) {
                                if (is_array($gallery->album)) {
                                    foreach ($gallery->album as $img) {
                                        $allImages->push(['url' => $img, 'name' => 'Tất Cả']);
                                    }
                                }
                            }
                        }
                    }
                @endphp

                <ul class="uk-subnav ln-gallery-page__tabs" data-uk-switcher="{connect:'#gallery-tabs'}" data-reveal="up">
                    <li><a href="#">Tất Cả ({{ $allImages->count() }})</a></li>
                    @foreach ($catalogueImages as $catName => $images)
                        @if ($images->count() > 0)
                            <li><a href="#">{{ $catName }} ({{ $images->count() }})</a></li>
                        @endif
                    @endforeach
                </ul>

                <ul id="gallery-tabs" class="uk-switcher">

                    <li>
                        <div class="hp-gallery-grid">
                            @if ($allImages->count() > 0)
                                @foreach ($allImages as $img)
                                    <a href="{{ $img['url'] }}" class="hp-gallery-item" data-fancybox="gallery-all"
                                        data-caption="{{ $img['name'] }}" data-reveal="up">
                                        <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" loading="lazy">
                                        <div class="hp-gallery-overlay">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                @for ($i = 1; $i <= 8; $i++)
                                    <a href="{{ asset('frontend/resources/img/homely/gallery/' . $i . '.webp') }}"
                                        class="hp-gallery-item" data-fancybox="gallery-all" data-reveal="up">
                                        <img src="{{ asset('frontend/resources/img/homely/gallery/' . $i . '.webp') }}"
                                            alt="Gallery {{ $i }}" loading="lazy">
                                        <div class="hp-gallery-overlay">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                    </a>
                                @endfor
                            @endif
                        </div>
                    </li>


                    @foreach ($catalogueImages as $catName => $images)
                        @if ($images->count() > 0)
                            <li>
                                <div class="hp-gallery-grid">
                                    @foreach ($images as $img)
                                        <a href="{{ $img['url'] }}" class="hp-gallery-item"
                                            data-fancybox="gallery-{{ Str::slug($catName) }}"
                                            data-caption="{{ $img['name'] }}" data-reveal="up">
                                            <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" loading="lazy">
                                            <div class="hp-gallery-overlay">
                                                <i class="fa fa-expand"></i>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>

    </div>
@endsection
