        document.addEventListener('DOMContentLoaded', function () {
            /* ---------- AOS ---------- */
            AOS.init({
                duration: 600,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50
            });

            /* ---------- Stores Swiper ---------- */
            new Swiper('.storesSwiper', {
                slidesPerView: 1,
                spaceBetween: 16,
                loop: false,
                navigation: {
                    nextEl: '.stores-section .swiper-button-next',
                    prevEl: '.stores-section .swiper-button-prev',
                },
                pagination: {
                    el: '.stores-section .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    576:  { slidesPerView: 2, spaceBetween: 20 },
                    768:  { slidesPerView: 2, spaceBetween: 24 },
                    992:  { slidesPerView: 3, spaceBetween: 24 },
                    1200: { slidesPerView: 3, spaceBetween: 30 }
                }
            });

            /* ---------- Hero: counter + progress bar ---------- */
            const heroCarousel = document.getElementById('heroSlider');
            if (!heroCarousel) return;

            const slides = heroCarousel.querySelectorAll('.carousel-item');
            const totalSlides = slides.length;
            const counterCurrent = heroCarousel.querySelector('.hero-counter .current');
            const counterTotal   = heroCarousel.querySelector('.hero-counter .total');
            const progressBar    = heroCarousel.querySelector('.hero-progress-bar');
            const interval       = parseInt(heroCarousel.dataset.bsInterval, 10) || 5000;

            if (counterTotal) {
                counterTotal.textContent = String(totalSlides).padStart(2, '0');
            }

            let progressTimer = null;
            let progressValue = 0;

            function updateCounter(index) {
                if (counterCurrent) {
                    counterCurrent.textContent = String(index + 1).padStart(2, '0');
                }
            }

            function resetProgress() {
                progressValue = 0;
                if (progressBar) progressBar.style.width = '0%';
            }

            function startProgress() {
                stopProgress();
                resetProgress();
                const step = 100 / (interval / 60);
                progressTimer = setInterval(() => {
                    progressValue += step;
                    if (progressValue >= 100) progressValue = 100;
                    if (progressBar) progressBar.style.width = progressValue + '%';
                }, 60);
            }

            function stopProgress() {
                if (progressTimer) {
                    clearInterval(progressTimer);
                    progressTimer = null;
                }
            }

            heroCarousel.addEventListener('slide.bs.carousel', function (e) {
                updateCounter(e.to);
                startProgress();
            });

            heroCarousel.addEventListener('mouseenter', stopProgress);
            heroCarousel.addEventListener('mouseleave', startProgress);

            startProgress();
        });