@extends('frontend.homepage.layout')
@section('header-class', 'header-inner')
@section('content')

    <section class="uk-cover-background uk-position-relative uk-block-large uk-contrast hp-hero-breadcrumb-premium-section"
        style="background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}');">
        <div class="hp-hero-overlay-blur"></div>
        <div class="uk-container uk-container-center uk-position-relative hp-z-10">
            <div class="uk-flex uk-flex-middle uk-flex-center uk-height-1-1">
                <div class="uk-width-1-1 uk-text-center">
                    <h1 class="hp-hero-title-premium uk-margin-small-bottom" data-reveal="up">
                        Tiện ích
                    </h1>
                    <ul class="uk-breadcrumb uk-flex-center hp-breadcrumb-premium" data-reveal="up">
                        <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                        <li class="hp-sep"><i class="fa fa-angle-right"></i></li>
                        <li class="uk-active"><span>Tiện ích cao cấp</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="hp-section bg-white hp-section-padding hp-border-top">
        <div class="uk-container uk-container-center">

            @php
                $defaultFeatures = [
                    [
                        'name' => 'Fast WI-FI',
                        'image' => asset('frontend/resources/img/homely/gallery/1.webp'),
                    ],
                    [
                        'name' => 'Swimming Pool',
                        'image' => asset('frontend/resources/img/homely/gallery/2.webp'),
                    ],
                    [
                        'name' => 'Parking Place',
                        'image' => asset('frontend/resources/img/homely/gallery/3.webp'),
                    ],
                    [
                        'name' => 'Smart Home',
                        'image' => asset('frontend/resources/img/homely/gallery/4.webp'),
                    ],
                    [
                        'name' => 'Green Garden',
                        'image' => asset('frontend/resources/img/homely/gallery/5.webp'),
                    ],
                    [
                        'name' => '24/7 Security',
                        'image' => asset('frontend/resources/img/homely/gallery/6.webp'),
                    ],
                ];
                $displayFeatures =
                    $facilities->count() > 0
                        ? $facilities->map(function ($f, $index) use ($defaultFeatures) {
                            return (object) [
                                'name' => $f->name,
                                'image' => $f->image ?? $defaultFeatures[$index % count($defaultFeatures)]['image'],
                            ];
                        })
                        : collect($defaultFeatures)->map(fn($f) => (object) $f);
            @endphp

            <div class="hp-amenity-grid">
                @foreach ($displayFeatures as $feature)
                    <div class="hp-amenity-card-premium" data-reveal="up">
                        <img src="{{ $feature->image }}" alt="{{ $feature->name }}" loading="lazy">
                        <div class="hp-amenity-card-overlay">
                            <h3 class="hp-amenity-card-title">{{ $feature->name }}</h3>
                            <div class="hp-amenity-arrow-btn">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
