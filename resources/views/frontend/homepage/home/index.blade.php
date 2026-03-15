@extends('frontend.homepage.layout')
@section('content')
    @php
        $allImages = collect();
        if (isset($galleries) && $galleries->count() > 0) {
            foreach ($galleries as $gallery) {
                if (is_array($gallery->album)) {
                    foreach ($gallery->album as $img) {
                        $allImages->push(['url' => $img, 'name' => $gallery->name ?? 'Không gian sống']);
                    }
                }
            }
        }
    @endphp
    <section class="hp-hero">
        <div class="hp-vertical-label hp-label-left">Giá bán {{ $property->price }} {{ $property->price_unit }}</div>
        <div class="hp-social-vertical">
            @if (!empty($system['social_facebook']))
                <a href="{{ $system['social_facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a>
            @endif
            @if (!empty($system['social_instagram']))
                <a href="{{ $system['social_instagram'] }}" target="_blank"><i class="fa fa-instagram"></i></a>
            @endif
            @if (!empty($system['social_youtube']))
                <a href="{{ $system['social_youtube'] }}" target="_blank"><i class="fa fa-youtube-play"></i></a>
            @endif
            @if (!empty($system['social_tiktok']))
                <a href="{{ $system['social_tiktok'] }}" target="_blank"><i class="fa fa-tiktok"></i></a>
            @endif
            @if (!empty($system['social_twitter']))
                <a href="{{ $system['social_twitter'] }}" target="_blank"><i class="fa fa-twitter"></i></a>
            @endif
        </div>
        <div class="hp-vertical-label hp-label-right">{{ $property->status ?? 'Đang bán' }} <span class="hp-m-10">|</span>
            Diện tích: {{ $property->area_sqm ?? '120m²' }} m²</div>

        <div class="swiper ln-hero-swiper hp-h-100">
            <div class="swiper-wrapper">
                @php
                    $sliderImages =
                        isset($allImages) && count($allImages) > 0
                            ? $allImages
                            : [asset('frontend/resources/img/homely/slider/1.webp')];
                @endphp
                <div class="swiper-slide hp-hero-slide hp-h-100" style="background-image: url('{{ $property->image }}')">
                    <div class="hp-hero-overlay"></div>
                    <div class="uk-container uk-container-center hp-hero-content uk-text-left">
                        <div class="hp-hero-content-grid">
                            <div class="hp-hero-text-side">
                                <h1 class="hp-hero-title-main" data-reveal="up">
                                    {{ $property->title ?? 'Mua, Bán & Cho Thuê Bất Động Sản Trong Mơ' }}
                                </h1>
                                <p class="hp-hero-subtitle-main" data-reveal="up">
                                    {{ $property->description_short ?? 'Khám phá những cơ hội bất động sản tốt nhất và tìm thấy ngôi nhà mơ ước của bạn tại những vị trí đắc địa nhất.' }}
                                </p>
                                <div class="hp-hero-btns" style="margin-top: 50px;" data-reveal="up">
                                    <div class="uk-flex uk-flex-middle">
                                        <a href="{{ $property->video_tour_url ?? '#' }}" data-fancybox
                                            class="hp-btn-play-orange-v2">
                                            <i class="fa fa-play"></i>
                                        </a>
                                        <span class="hp-watch-text">TOÀN CẢNH CĂN HỘ</span>
                                    </div>
                                </div>
                            </div>

                            <div class="hp-hero-form-side" data-reveal="left">
                                <div class="hp-form-tab-orange">
                                    XEM CĂN HỘ
                                </div>
                                <div class="hp-form-body">
                                    <form action="{{ route('visit-request.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="property_id" value="{{ $property->id ?? '' }}">

                                        <div class="hp-visit-field">
                                            <label>Họ và tên</label>
                                            <input type="text" name="full_name" placeholder="Nhập họ và tên..."
                                                class="hp-visit-input" required>
                                        </div>

                                        <div class="uk-grid uk-grid-small uk-margin-bottom" data-uk-grid-margin>
                                            <div class="uk-width-1-2">
                                                <div class="hp-visit-field">
                                                    <label>Số điện thoại</label>
                                                    <input type="text" name="phone" placeholder="Số điện thoại..."
                                                        class="hp-visit-input" required>
                                                </div>
                                            </div>
                                            <div class="uk-width-1-2">
                                                <div class="hp-visit-field">
                                                    <label>Email</label>
                                                    <input type="email" name="email" placeholder="Địa chỉ email..."
                                                        class="hp-visit-input" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small uk-margin-bottom" data-uk-grid-margin>
                                            <div class="uk-width-1-2">
                                                <div class="hp-visit-field">
                                                    <label>Ngày xem</label>
                                                    <input type="date" name="preferred_date" class="hp-visit-input">
                                                </div>
                                            </div>
                                            <div class="uk-width-1-2">
                                                <div class="hp-visit-field">
                                                    <label>Giờ xem</label>
                                                    <input type="time" name="preferred_time" class="hp-visit-input">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hp-visit-field uk-margin-bottom">
                                            <label>Lời nhắn</label>
                                            <input type="text" name="message" placeholder="Bạn quan tâm đến điều gì?"
                                                class="hp-visit-input">
                                        </div>

                                        <button type="submit" class="hp-btn-search-black-v2">
                                            <i class="fa fa-paper-plane" style="margin-right: 12px;"></i> GỬI YÊU CẦU
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @php
        $propTitle = $property->title ?? 'Inclub Residence';
        $propDesc =
            $property->description ??
            'Khám phá những cơ hội bất động sản tốt nhất và tìm thấy ngôi nhà mơ ước của bạn tại những vị trí đắc địa nhất.';

        $album = [];
        if (isset($galleries) && $galleries->isNotEmpty()) {
            $firstGallery = $galleries->first();
            if (is_string($firstGallery->album)) {
                $album = json_decode($firstGallery->album, true);
            } elseif (is_array($firstGallery->album)) {
                $album = $firstGallery->album;
            }
        }

        $img0 = $album[0] ?? asset('frontend/resources/img/homely/gallery/1.webp');
        $img1 = $album[1] ?? asset('frontend/resources/img/homely/gallery/2.webp');
        $img2 = $album[2] ?? asset('frontend/resources/img/homely/gallery/3.webp');

        $videoUrl = $property->video_tour_url ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
    @endphp

    <section class="hp-section hp-section-padding bg-white">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-large uk-flex-middle" data-uk-grid-margin>
                <div class="uk-width-large-1-2">
                    <div class="hp-collage-container" data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:300}">
                        <div class="hp-collage-grid">
                            <div class="hp-collage-main">
                                <img src="{{ $img0 }}" alt="Main Project View">
                            </div>
                            <div class="hp-collage-side">
                                <div class="hp-collage-sub hp-collage-sub-top">
                                    <img src="{{ $img1 }}" alt="Sub View 1">
                                </div>
                                <div class="hp-collage-sub hp-collage-sub-bottom">
                                    <img src="{{ $img2 }}" alt="Sub View 2">
                                </div>
                            </div>
                        </div>
                        <!-- Centered Play Button -->
                        <div class="hp-collage-play-wrap">
                            <a href="{{ $videoUrl }}" data-fancybox class="hp-btn-play-center">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Content -->
                <div class="uk-width-large-1-2">
                    <div class="hp-overview-content" data-uk-scrollspy="{cls:'uk-animation-slide-right', delay:500}">
                        <div class="hp-section-label">
                            VỀ CHÚNG TÔI
                        </div>
                        <h2 class="hp-section-title">
                            {{ $propTitle }}
                        </h2>
                        <div class="hp-overview-desc">
                            {!! $propDesc !!}
                        </div>

                        <div class="hp-overview-features">
                            @php
                                $overviewFeatures = [];
                                if (isset($facilities) && $facilities->isNotEmpty()) {
                                    $overviewFeatures = $facilities->take(2);
                                }
                            @endphp

                            @if (count($overviewFeatures) > 0)
                                @foreach ($overviewFeatures as $feature)
                                    <div class="hp-feature-item uk-flex uk-flex-top">
                                        <div class="hp-feature-icon">
                                            @if (!empty($feature->icon))
                                                <i class="{{ $feature->icon }} text-primary"
                                                    style="font-size: 24px;"></i>
                                            @else
                                                <img src="{{ !empty($feature->image) ? asset($feature->image) : 'https://cdn-icons-png.flaticon.com/512/1067/1067561.png' }}"
                                                    alt="{{ $feature->name ?? 'Icon' }}">
                                            @endif
                                        </div>
                                        <div class="hp-feature-text">
                                            <h4>{{ $feature->name ?? '' }}</h4>
                                            <p>{{ Str::limit(strip_tags($feature->description ?? 'Tiện ích cao cấp bậc nhất tại khu vực.'), 120) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="hp-feature-item uk-flex uk-flex-top">
                                    <div class="hp-feature-icon">
                                        <img src="{{ asset('frontend/resources/img/icons/solution.svg') }}"
                                            alt="Icon"
                                            onerror="this.src='https://cdn-icons-png.flaticon.com/512/1067/1067561.png'">
                                    </div>
                                    <div class="hp-feature-text">
                                        <h4>Giải pháp tối ưu</h4>
                                        <p>Chúng tôi mang đến những giải pháp thiết kế thông minh, tối ưu hóa không gian
                                            sống và
                                            công năng sử dụng.</p>
                                    </div>
                                </div>
                                <div class="hp-feature-item uk-flex uk-flex-top">
                                    <div class="hp-feature-icon">
                                        <img src="{{ asset('frontend/resources/img/icons/quality.svg') }}" alt="Icon"
                                            onerror="this.src='https://cdn-icons-png.flaticon.com/512/3126/3126647.png'">
                                    </div>
                                    <div class="hp-feature-text">
                                        <h4>Cam kết chất lượng</h4>
                                        <p>Mỗi công trình là một lời cam kết về chất lượng bền bỉ và tính thẩm mỹ vượt thời
                                            gian.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="hp-overview-action uk-flex uk-flex-middle">
                            <a href="#hp-popular-areas" class="hp-btn-learn-more">
                                XEM THÊM <i class="fa fa-arrow-right"></i>
                            </a>
                            <div class="hp-overview-hotline uk-flex uk-flex-middle">
                                <div class="hp-hotline-circle">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="hp-hotline-text">
                                    <span>Hỗ trợ 24/7</span>
                                    <strong>{{ $system['contact_hotline'] ?? '0 (123) 456 789' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $album = [];
        if (isset($property->album) && !empty($property->album)) {
            $propAlbum = is_string($property->album) ? json_decode($property->album, true) : $property->album;
            if (is_array($propAlbum)) {
                $album = array_merge($album, $propAlbum);
            }
        }
        if (isset($galleries) && $galleries->isNotEmpty()) {
            foreach ($galleries as $gallery) {
                if (!empty($gallery->album)) {
                    $galAlbum = is_string($gallery->album) ? json_decode($gallery->album, true) : $gallery->album;
                    if (is_array($galAlbum)) {
                        $album = array_merge($album, $galAlbum);
                    }
                }
            }
        }

        $album = array_unique($album);

        if (empty($album)) {
            for ($i = 1; $i <= 16; $i++) {
                $album[] = 'https://picsum.photos/800/600?random=' . $i;
            }
        }
        $imageChunks = array_chunk($album, 8);
    @endphp

    <section class="hp-section hp-section-padding bg-white" id="hp-gallery">
        <div class="uk-container uk-container-center">
            <div class="hp-gallery-header" data-uk-scrollspy="{cls:'uk-animation-fade', delay:300}">
                <div class="hp-gallery-header-left">
                    <div class="hp-section-label">Thư viện hình ảnh</div>
                    <h2 class="hp-section-title">Không gian sống sang trọng & đẳng cấp</h2>
                </div>
                <div class="hp-gallery-header-right">
                    <p class="hp-overview-desc">
                        Từng góc nhỏ trong căn hộ đều được chăm chút kỹ lưỡng, mang lại cảm giác ấm cúng nhưng không kém
                        phần sang trọng. Khám phá vẻ đẹp kiến trúc tinh tế qua từng khung hình được ghi lại từ chính dự án.
                    </p>
                </div>
            </div>

            <div class="hp-gallery-slider-wrap" data-uk-scrollspy="{cls:'uk-animation-slide-bottom', delay:500}">
                <div class="swiper hp-gallery-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($imageChunks as $chunk)
                            <div class="swiper-slide hp-gallery-grid-slide">
                                @foreach ($chunk as $img)
                                    <a href="{{ $img }}" class="hp-gallery-card"
                                        data-fancybox="property-gallery">
                                        <img src="{{ $img }}" alt="Gallery Image">
                                        <div class="hp-gallery-overlay">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="hp-gallery-nav-btn hp-gallery-prev">
                    <i class="fa fa-chevron-left"></i>
                </div>
                <div class="hp-gallery-nav-btn hp-gallery-next">
                    <i class="fa fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="hp-section hp-section-padding bg-white" id="hp-property-overview">
        <div class="uk-container uk-container-center">
            <div class="uk-text-center uk-margin-large-bottom" data-uk-scrollspy="{cls:'uk-animation-fade', delay:300}">
                <div class="hp-section-label">TỔNG QUAN TÀI SẢN</div>
                <h2 class="hp-section-title">THÔNG TIN CHI TIẾT VỀ CĂN HỘ</h2>
            </div>

            <div class="hp-floorplan-container">
                @if (isset($floorplans) && $floorplans->isNotEmpty())
                    <ul class="hp-floorplan-tabs uk-flex uk-flex-center" data-uk-tab="{connect:'#hp-floorplan-switcher'}">
                        @foreach ($floorplans as $plan)
                            <li class="{{ $loop->first ? 'uk-active' : '' }}">
                                <a href="javascript:void(0)">{{ $plan->floor_label }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <ul id="hp-floorplan-switcher" class="uk-switcher uk-margin-large-top">
                        @foreach ($floorplans as $plan)
                            <li>
                                <div class="uk-grid uk-grid-large" data-uk-grid-margin>
                                    <div class="uk-width-large-1-2">
                                        <a href="{{ $plan->plan_image }}" data-fancybox="floorplan-{{ $plan->id }}"
                                            class="hp-floorplan-image">
                                            <img src="{{ $plan->plan_image }}" alt="{{ $plan->floor_label }}">
                                        </a>
                                    </div>
                                    <div class="uk-width-large-1-2">
                                        <div class="hp-floorplan-info">
                                            <h3 class="hp-floorplan-title">{{ $plan->floor_label }}</h3>
                                            <p class="hp-overview-desc">
                                                Căn hộ được thiết kế tối ưu với đầy đủ các khu vực chức năng, mang lại
                                                sự tiện nghi và thoải mái tuyệt đối cho cư dân.
                                            </p>

                                            @if ($plan->rooms->isNotEmpty())
                                                <div class="hp-floorplan-rooms uk-margin-large-top">
                                                    <h4 class="hp-rooms-title">Chi tiết các phòng:</h4>
                                                    <table class="uk-table uk-table-divider hp-rooms-table">
                                                        <tbody>
                                                            @foreach ($plan->rooms as $room)
                                                                <tr>
                                                                    <td class="uk-text-left">{{ $room->room_name }}</td>
                                                                    <td class="uk-text-right"
                                                                        style="color: var(--hp-primary); font-weight: 500;">
                                                                        {{ $room->area_sqm }} m²
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>


    <section class="hp-cta-section hp-section-padding" id="hp-contact-cta" data-reveal="fade">
        <div class="uk-container uk-container-center uk-text-center">
            <div class="hp-section-label uk-flex-center" style="color: #fff">LIÊN HỆ VỚI CHÚNG TÔI</div>
            <h2 class="hp-cta-title">BẠN ĐANG TÌM KIẾM NGÔI NHÀ MƠ ƯỚC?</h2>
            <p class="hp-cta-desc">
                Khám phá những cơ hội bất động sản tốt nhất và tìm thấy tổ ấm lý tưởng của bạn cùng đội ngũ chuyên gia tận
                tâm.
            </p>
            <div class="hp-cta-action">
                <a href="{{ url('lien-he.html') }}" class="hp-btn-white">
                    LIÊN HỆ NGAY
                </a>
            </div>
        </div>
    </section>

    {{-- Popular Areas Section (Xung quanh) --}}
    <section class="hp-section hp-section-dark hp-section-padding" id="hp-popular-areas">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-large" data-uk-grid-margin>
                {{-- Left Side: Title & Info --}}
                <div class="uk-width-large-1-3" data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:300}">
                    <div class="hp-section-label hp-text-white" style="color: #fff;">TIỆN ÍCH NGOẠI KHU</div>
                    <h2 class="hp-section-title hp-text-white" style="color: #fff;">KHÁM PHÁ XUNG QUANH</h2>
                    <p class="hp-section-desc hp-text-silver uk-margin-large-bottom" style="color: #aaa;">
                        {{ $property->title }} tọa lạc tại vị trí vàng, nơi kết nối hoàn hảo với các tiện ích hiện đại như
                        trường học, bệnh viện, trung tâm thương mại và các nút giao thông trọng điểm.
                    </p>
                    <a href="/lien-he.html" class="hp-btn hp-btn-primary">
                        LIÊN HỆ NGAY <i class="fa fa-caret-right" style="margin-left: 10px;"></i>
                    </a>
                </div>

                {{-- Right Side: Slider --}}
                <div class="uk-width-large-2-3" data-uk-scrollspy="{cls:'uk-animation-fade', delay:500}">
                    <div class="swiper hp-areas-swiper">
                        <div class="swiper-wrapper">
                            @if (isset($locationHighlights) && $locationHighlights->isNotEmpty())
                                @php
                                    $bgImages = $album;
                                    if (count($bgImages) < $locationHighlights->count()) {
                                        for ($i = count($bgImages); $i < $locationHighlights->count(); $i++) {
                                            $bgImages[] = asset('frontend/resources/img/homely/slider/1.webp');
                                        }
                                    }
                                @endphp
                                @foreach ($locationHighlights as $index => $item)
                                    <div class="swiper-slide">
                                        <div class="hp-area-card">
                                            @php
                                                $imageUrl = $bgImages[$index % count($bgImages)];
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $item->name }}"
                                                class="hp-area-img">
                                            <div class="hp-area-overlay">
                                                <div class="hp-area-content">
                                                    <h3 class="hp-area-name">{{ $item->name }}</h3>
                                                    <div class="hp-area-dist">
                                                        <i class="fa fa-map-marker"></i>
                                                        {{ $item->distance_text ?? 'Cách 5 phút' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @for ($i = 1; $i <= 6; $i++)
                                    <div class="swiper-slide">
                                        <div class="hp-area-card">
                                            <img src="https://picsum.photos/seed/area{{ $i }}/600/800"
                                                alt="Mock Area" class="hp-area-img">
                                            <div class="hp-area-overlay">
                                                <div class="hp-area-content">
                                                    <h3 class="hp-area-name">Địa điểm nổi bật {{ $i }}</h3>
                                                    <div class="hp-area-dist">
                                                        <i class="fa fa-map-marker"></i> Cách {{ $i * 5 }} phút
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="hp-section hp-section-padding bg-white"
        data-uk-scrollspy="{cls:'uk-animation-slide-bottom', delay:200}">
        <div class="uk-container uk-container-center" data-uk-scrollspy="{cls:'uk-animation-fade', delay:300}">
            <div class="hp-news-header">
                <div class="hp-section-label">CẬP NHẬT THỊ TRƯỜNG</div>
                <h2 class="hp-section-title">BÀI VIẾT MỚI NHẤT</h2>
            </div>

            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                @if (isset($posts) && count($posts) > 0)
                    @foreach ($posts->take(4) as $post)
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

                            $catName = '';
                            if ($post->post_catalogues->count() > 0) {
                                $cat = $post->post_catalogues->first();
                                if ($cat->languages->isNotEmpty()) {
                                    $catName = $cat->languages->first()->pivot->name ?? '';
                                }
                            }
                        @endphp
                        <div class="uk-width-large-1-4 uk-width-medium-1-2 uk-margin-bottom">
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
                                        <a href="{{ $postUrl }}">{{ Str::limit($postName, 50) }}</a>
                                    </h3>
                                    <p class="hp-post-card__excerpt">
                                        {{ Str::limit(html_entity_decode(strip_tags($post->description ?? '')), 80) }}
                                    </p>
                                </div>
                            </article>
                        </div>
                    @endforeach
                @else
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="uk-width-large-1-4 uk-width-medium-1-2 uk-margin-bottom">
                            <article class="hp-post-card" data-reveal="up">
                                <div class="hp-post-card__img">
                                    <a href="#">
                                        <img src="{{ asset('frontend/resources/img/homely/gallery/' . (($i % 8) + 1) . '.webp') }}"
                                            alt="Mock News">
                                    </a>
                                </div>
                                <div class="hp-post-card__body">
                                    <div class="hp-post-card__meta">
                                        {{ \Carbon\Carbon::now()->translatedFormat('d \T\h\á\n\g m, Y') }}
                                    </div>
                                    <h3 class="hp-post-card__title">
                                        <a href="#">Xu Hướng BĐS Cao Cấp Năm {{ date('Y') }} Có Gì Mới?</a>
                                    </h3>
                                    <p class="hp-post-card__excerpt">
                                        Khám phá những xu hướng kiến trúc và tiện ích đẳng cấp nhất đang dẫn đầu thị trường.
                                    </p>
                                </div>
                            </article>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
@endsection
