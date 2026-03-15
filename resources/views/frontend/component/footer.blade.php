<footer class="hp-footer-centered">
    <div class="uk-container uk-container-center">
        <div class="hp-footer-content uk-text-center">
            <!-- Company/Realtor Name -->
            <h2 class="hp-footer-name uk-margin-bottom">
                {{ $system['homepage_company'] ?? 'Mona Simpson' }}
            </h2>
            <div class="hp-footer-role uk-margin-bottom">
                {{ $system['homepage_description'] ?? 'Portland Realtor' }}
            </div>

            <!-- Contact Strip -->
            <div class="hp-footer-contact-strip uk-flex uk-flex-center uk-flex-middle">
                <span class="hp-contact-item">
                    {{ $system['contact_hotline'] ?? '(530) 577-8027' }}
                </span>
                <span class="hp-sep">|</span>
                <span class="hp-contact-item">
                    {{ $system['contact_address'] ?? '72 Lorne Hill Road, New York' }}
                </span>
                <span class="hp-sep">|</span>
                <span class="hp-contact-item">
                    <a href="/lien-he.html" class="hp-contact-link">Liên hệ ngay</a>
                </span>
            </div>

            <!-- Footer Menu & Logo -->
            <div class="hp-footer-nav-wrap uk-margin-large-bottom">
                <div class="uk-grid uk-grid-collapse uk-flex-middle">
                    <div class="uk-width-medium-2-5">
                        <ul class="hp-footer-menu hp-left-menu">
                            @if(isset($menu['footer-left']))
                                {!! $menu['footer-left'] !!}
                            @else
                                <li><a href="/">Trang chủ</a></li>
                                <li><a href="/gioi-thieu.html">Giới thiệu</a></li>
                                <li><a href="/vi-tri.html">Vị trí</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="uk-width-medium-1-5">
                        <div class="hp-footer-centered-logo">
                            <a href="/">
                                <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/img/homely/logo.webp') }}"
                                    alt="Logo" style="max-height: 50px;">
                            </a>
                        </div>
                    </div>
                    <div class="uk-width-medium-2-5">
                        <ul class="hp-footer-menu hp-right-menu">
                            @if(isset($menu['footer-right']))
                                {!! $menu['footer-right'] !!}
                            @else
                                <li><a href="/tien-ich.html">Tiện ích</a></li>
                                <li><a href="/tin-tuc.html">Tin tức</a></li>
                                <li><a href="/lien-he.html">Liên hệ</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Social Icons -->
            <div class="hp-footer-centered-socials uk-flex uk-flex-center">
                @if (!empty($system['social_facebook']))
                    <a href="{{ $system['social_facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a>
                @endif
                @if (!empty($system['social_twitter']))
                    <a href="{{ $system['social_twitter'] }}" target="_blank"><i class="fa fa-twitter"></i></a>
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
            </div>

            <div class="hp-footer-centered-copyright">
                {!! $system['homepage_copyright'] ?? '© ' . date('Y') . ' HP Residence. All rights reserved.' !!}
            </div>
        </div>
    </div>
</footer>

@include('frontend.component.floating-social')
