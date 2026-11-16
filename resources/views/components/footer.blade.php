<footer class="ct-custom-footer">
    <div class="ct-footer-container">
        
        <!-- Decorative Background Elements -->
        <div class="ct-decor-elements">
            <!-- Sale Stamp -->
            <div class="decor-stamp">
                <i class="fa-solid fa-star"></i> % <br> @lang('common.sale')
            </div>
            <!-- Floating Images -->
            <img src="{{ asset('assets/img/footer/image1.webp') }}" alt="Money" class="decor-img img-money" onerror="this.style.display='none'">
            <img src="{{ asset('assets/img/footer/image2.webp') }}" alt="Gift" class="decor-img img-gift" onerror="this.style.display='none'">
            <img src="{{ asset('assets/img/footer/image3.webp') }}" alt="Phone" class="decor-img img-phone" onerror="this.style.display='none'">
        </div>

        <!-- Big Script Title -->
        <div class="ct-footer-title-wrapper">
            <h1 class="ct-footer-script-title">{{ config('app.name', 'Coupon Thunder') }}</h1>
        </div>

        <!-- Main Grid Content -->
        <div class="ct-footer-grid">
            
            <!-- Column 1: About Us -->
            <div class="ct-footer-col">
                <h4>@lang('common.about')</h4>
                <p>@lang('common.footer_about_text')</p>
                <div class="ct-social-icons">
                    <a href="https://www.facebook.com/couponthunder" target="_blank" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/couponthunderz" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@coupon.thunder" target="_blank" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="ct-footer-col">
                <h4>@lang('common.quick_links')</h4>
                <ul class="ct-footer-links">
                    <li><a href="{{ route('about', ['lang' => app()->getLocale()]) }}">@lang('common.about')</a></li>
                    <li><a href="{{ route('contact', ['lang' => app()->getLocale()]) }}">@lang('common.contact')</a></li>
                    <li><a href="{{ route('terms', ['lang' => app()->getLocale()]) }}">@lang('common.terms_of_service')</a></li>
                    <li><a href="{{ route('privacy', ['lang' => app()->getLocale()]) }}">@lang('common.privacy_policy')</a></li>
                    <li><a href="{{ route('imprint', ['lang' => app()->getLocale()]) }}">@lang('common.imprint')</a></li>
                </ul>
            </div>

            <!-- Column 3: Subscribe -->
            <div class="ct-footer-col">
                <h4>@lang('common.subscribe')</h4>
                <p>@lang('common.footer_subscribe_text')</p>
                <form class="ct-newsletter-form">
                    <input type="email" placeholder="@lang('common.enter_email')" required aria-label="@lang('common.enter_email')">
                    <button type="submit" aria-label="@lang('common.subscribe')">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>

        </div>

        <!-- Bottom Tagline -->
        <div class="ct-footer-tagline">
            <h2>@lang('common.footer_tagline')</h2>
        </div>

        <!-- Copyright Bar -->
        <div class="ct-footer-copyright">
            @lang('common.copyright', ['year' => date('Y'), 'name' => config('app.name', 'Coupon Thunder')])
        </div>

    </div>
</footer>