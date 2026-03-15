<header class="hp-header @yield('header-class')" id="hp-header">
    <div class="hp-header-top">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-collapse uk-flex-middle">
                <div class="uk-width-large-1-4 uk-width-1-3">
                    <div class="logo">
                        <a href="/" title="logo">
                            <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/img/homely/logo.webp') }}"
                                alt="logo" style="max-height: 50px;">
                        </a>
                    </div>
                </div>

                <div class="uk-width-large-1-2 uk-visible-large">
                    <ul class="hp-nav-localized uk-flex-center">
                        {!! $menu['main-menu'] ?? '' !!}
                    </ul>
                </div>

                <div class="uk-width-large-1-4 uk-width-2-3 uk-text-right">
                    <div class="uk-flex uk-flex-middle uk-flex-right">
                        <div class="hp-hotline-wrap uk-visible-large">
                            <i class="fa fa-phone"></i>
                            <span>{{ $system['contact_hotline'] ?? '+1 206-741-0340' }}</span>
                        </div>

                        <a class="hp-hamburger uk-hidden-large" href="#offcanvas-mobile"
                            data-uk-offcanvas="{target:'#offcanvas-mobile'}" style="color: #fff; margin-left: 20px;">
                            <i class="fa fa-bars" style="font-size: 26px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@include('frontend.component.sidebar')
