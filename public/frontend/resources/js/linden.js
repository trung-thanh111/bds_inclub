document.addEventListener('DOMContentLoaded', function () {

    if (document.querySelector('.ln-hero-swiper')) {
        var slideSettings = {
            loop: true,
            effect: 'fade',
            speed: 1200,
            autoplay: { delay: 5000, disableOnInteraction: false }
        };
        if (window.LindenHeroSettings) {
            var s = window.LindenHeroSettings;
            if (s.animation) slideSettings.effect = s.animation;
            if (s.autoplay === 'accept') {
                slideSettings.autoplay = {
                    delay: s.animationDelay ? parseFloat(s.animationDelay) * 1000 : 5000,
                    disableOnInteraction: s.pauseHover !== 'accept'
                };
            }
        }
        new Swiper('.ln-hero-swiper', slideSettings);
    }

    if (document.querySelector('.ln-gallery-swiper')) {
        new Swiper('.ln-gallery-swiper', {
            slidesPerView: 'auto',
            spaceBetween: 30,
            centeredSlides: true,
            loop: true,
            grabCursor: true,
            navigation: { nextEl: '.gallery-next', prevEl: '.gallery-prev' }
        });
    }

    if (document.querySelector('.ln-amenity-swiper')) {
        new Swiper('.ln-amenity-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            speed: 800,
            autoplay: { delay: 4000, disableOnInteraction: false },
            navigation: { nextEl: '.amenity-next', prevEl: '.amenity-prev' }
        });
    }

    if (document.querySelector('.ln-building-swiper')) {
        new Swiper('.ln-building-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            speed: 800,
            autoplay: { delay: 4000, disableOnInteraction: false },
            navigation: { nextEl: '.building-next', prevEl: '.building-prev' }
        });
    }

    if (document.querySelector('.ln-interior-swiper')) {
        new Swiper('.ln-interior-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            speed: 800,
            navigation: { nextEl: '.interior-next', prevEl: '.interior-prev' }
        });
    }

    if (document.querySelector('.ln-location-swiper')) {
        new Swiper('.ln-location-swiper', {
            slidesPerView: 4.5,
            spaceBetween: 20,
            grabCursor: true,
            navigation: { nextEl: '.loc-next', prevEl: '.loc-prev' },
            breakpoints: {
                0: { slidesPerView: 1.2 },
                640: { slidesPerView: 2.2 },
                960: { slidesPerView: 3.5 },
                1200: { slidesPerView: 4.5 }
            }
        });
    }

    if (document.querySelector('.hp-areas-swiper')) {
        new Swiper('.hp-areas-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 30
                }
            }
        });
    }

    // Fancybox initialization
    if (typeof Fancybox !== 'undefined') {
        Fancybox.bind("[data-fancybox]", {});
    }

    // Back to top logic (HP version)
    const hpBackToTop = document.getElementById('hp-back-to-top');
    if (hpBackToTop) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                hpBackToTop.classList.add('active');
            } else {
                hpBackToTop.classList.remove('active');
            }
        });

        hpBackToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // AJAX Form Submission for Visit Request (Premium version)
    const visitForms = document.querySelectorAll('form[action*="visit-request/store"]');
    visitForms.forEach(function(visitForm) {
        visitForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang gửi...';
            }

            const formData = new FormData(form);
            const url = form.getAttribute('action');
            const csrfTokenElement = document.querySelector('input[name="_token"]');
            const csrfToken = csrfTokenElement ? csrfTokenElement.value : '';

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (typeof toastr !== 'undefined') {
                        toastr.success(data.message || 'Yêu cầu của bạn đã được gửi thành công!');
                    }
                    form.reset();
                } else {
                    if (typeof toastr !== 'undefined') {
                        toastr.error(data.message || 'Có lỗi xảy ra, vui lòng thử lại.');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof toastr !== 'undefined') {
                    toastr.error('Không thể kết nối tới máy chủ. Vui lòng thử lại sau.');
                }
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                }
            });
        });
    });

});
