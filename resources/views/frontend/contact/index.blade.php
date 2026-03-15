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
                            Liên hệ
                        </h1>
                        <ul class="uk-breadcrumb uk-flex-center hp-breadcrumb-premium" data-reveal="up">
                            <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                            <li class="hp-sep"><i class="fa fa-angle-right"></i></li>
                            <li class="uk-active"><span>Liên hệ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="hp-section bg-white hp-section-padding">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-large uk-flex-middle" data-uk-grid-margin>
                    <!-- Left: Project Info -->
                    <div class="uk-width-large-1-2">
                        <div class="hp-contact-project-info" data-reveal="left">
                            <div class="hp-section-label" style="color: var(--hp-primary);">Liên hệ</div>
                            <h2 class="hp-contact-project-title">Kết Nối Với Chúng Tôi Để<br>Kiến Tạo Tương Lai</h2>

                            <div class="hp-contact-detail-list">
                                <div class="hp-contact-detail-item">
                                    <div class="hp-contact-detail-icon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="hp-contact-detail-content">
                                        <h4>Địa chỉ dự án</h4>
                                        <p>{{ $property->address ?? '742 Evergreen Terrace, Quận 7, TP. HCM' }}</p>
                                    </div>
                                </div>

                                <div class="hp-contact-detail-item">
                                    <div class="hp-contact-detail-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="hp-contact-detail-content">
                                        <h4>Hotline tư vấn</h4>
                                        <p>{{ $system['contact_hotline'] ?? '(+84) 123 456 789' }}</p>
                                    </div>
                                </div>

                                <div class="hp-contact-detail-item">
                                    <div class="hp-contact-detail-icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="hp-contact-detail-content">
                                        <h4>Email hỗ trợ</h4>
                                        <p>{{ $system['contact_email'] ?? 'hello@homepark.com' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Form -->
                    <div class="uk-width-large-1-2">
                        <div class="hp-contact-form-premium" data-reveal="right">
                            <h3 class="uk-margin-medium-bottom"
                                style="font-family: var(--hp-font-serif); font-weight: 700; font-size: 24px;">Gửi yêu cầu tư
                                vấn</h3>
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
        </section>

    </div>
@endsection
